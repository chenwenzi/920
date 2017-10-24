<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后台登陆控制器
 */
class Login extends CI_Controller{
    /**
     * 登陆默认方法
     * @return [type] [description]
     */
    public function index(){
        // //载入验证码辅助函数
        // $this->load->helper('captcha');

        // $speed = 'sfljlwjqrljlfafasdfasldfj1231443534507698';
        // $word = '';
        // for($i = 0; $i < 4; $i++){
        // 	$word .= $speed[mt_rand(0, strlen($speed) - 1)];
        // }

        // //配置项
        // $vals = array(
        // 	'word'	=> $word,
        // 	'img_path' => './captcha/',
        // 	'img_url'  => base_url() . '/captcha/',
        // 	'img_width'=> 80,
        // 	'img_height'=>25,
        // 	'expiration'=>60
        // 	);
        // //创建验证码
        // $cap = create_captcha($vals);
        // if(!isset($_SESSION)){
        // 	session_start();
        // }
        // $_SESSION['code'] = $cap['word'];
        // $data['captcha'] = $cap['image'];
        // print_const();die;
        $this->load->view('admin/login');
    }


    /**
     * 验证码
     */
    public function code(){
        $config = array(
            'width' => 80,
            'height'=> 25,
            'codeLen'=> 1,
            'fontSize'=>16
        );
        $this->load->library('code', $config);

        $this->code->show();

    }


    /**
     * 登陆
     */
    public function login_in(){
        $code = $this->input->post('captcha');
        if(!isset($_SESSION)){
            session_start();
        }
        //if(strtoupper($code) != $_SESSION['code']) error('验证码错误');

        $username = $this->input->post('username');
        $this->load->model('admin_model');
        $userData = $this->admin_model->check($username);

        $passwd = $this->input->post('passwd');
        $username = trim($username);
        $passwd = trim($passwd);

        if(empty($userData[0]['passwd'])) {
            error('用户名或者密码不正确');
            return;
        }
       if($userData[0]['passwd'] != md5($passwd) && str_ireplace('md5_','',$passwd) != $userData[0]['passwd']) {
            error('用户名或者密码不正确');
            return;
        }

        $sessionData = array(
            'username'  => $username,
            'uid'       => $userData[0]['uid'],
            'user_type' => $userData[0]['type'], //0: admin 1:教师 2:学校
            'is_admin'  => in_array($username, ['admin']) ? true : false,
            'logintime' => time(),
        );

        $this->session->set_userdata($sessionData);
        header('Location: /admin/admin/index');
        //success('admin/admin/index', '登陆成功');

    }


    /**
     * 退出登陆
     */
    public function login_out(){
        $this->session->sess_destroy();
        header('Location: /');
        //success('admin/login/index','退出成功');
    }

    /**
     * 退出登陆 AJAX
     */
    public function j_login_out(){
        $this->session->sess_destroy();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['code'=>0]));
    }

}