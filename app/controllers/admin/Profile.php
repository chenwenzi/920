<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller{
    /**
     * 个人档
     */
    public function index(){

        $this->load->model('profile_model');
        $data['profile'] = $this->profile_model->get_profiles();
        //p($data);die;
        $this->load->view('admin/profile', $data);
    }
    /**
     * 发表文章模板显示
     */
    public function news(){
        $this->load->model('profile_model');
        $data = [
            'school' => $this->profile_model->get_school(),
        ];
        //p($data);die;
        $this->load->helper('form');
        $this->load->view('admin/new_profile', $data);
    }



    public function check_upload_pic()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048000';
        $config['file_name'] = time() . mt_rand(1000,9999);
        $this->load->library('upload', $config);
        //上传图片处理
        if ( ! $this->upload->do_upload('avatar'))
        {
            $this->form_validation->set_message('check_upload_pic', $this->upload->display_errors());
            return false;
        } else {
            return true;
        }
    }
    /**
     * ！！！这里用不到， 学习和教师档案是初始化进数据库的
     * 添加教师或学习档案
     */
    public function add(){

        $this->load->model('profile_model');
        if($this->profile_model->have_profile()){
            $this->do_edit();
            return;
        }

        //载入表单验证类
        $this->load->library('form_validation');
        $status = $this->form_validation->run('profile');

        if($status){
            $data = array(
                'uid'      => $this->session->uid,
                'title'    => $this->session->username,
                'avatar'   => $this->upload('avatar'),
                'imgs'     => '', //
                'sid'      => $this->input->post('sid'),
                'wx'       => $this->input->post('wx'),
                'wx_qr'    => '',//$this->input->post('wx_qr'),
                'info'     => $this->input->post('info'),
                'intro'    => htmlspecialchars_decode($this->input->post('intro')),
                'more'     => '',
                'regtime'  => date("Y-m-d H:i:s"),
            );
            //p($data);die;
            //添加档案
            if($this->profile_model->add($data) === FALSE) {
                success('admin/profile/index', '档案添加失败');
            }else{
                success('admin/profile/index', '档案添加成功', true);
            }
        }else {
            $this->news();
        }
    }

    /**
     * 编辑文章
     */
    public function edit(){

        $this->load->model('profile_model');
        $data = [
            'profile'     => $this->profile_model->get_profiles(),
            'school' => $this->profile_model->get_school(),
        ];
        //p($data);return;
        $this->load->helper('form');
        $this->load->view('admin/edit_profile', $data);
    }


    /**
     * 编辑动作
     */
    public function do_edit(){

        //表单验证
        $this->load->library('form_validation');
        $status = $this->form_validation->run('profile_eidt');

        //验证通过
        if($status){
            $this->load->model('profile_model');
            $post = array(
                'sid'      => $this->input->post('sid'),
                'wx'       => $this->input->post('wx'),
                //'wx_qr'    => $this->input->post('wx_qr'),
                'info'     => $this->input->post('info'),
                'intro'    => htmlspecialchars_decode($this->input->post('intro')),
            );
            //不为空就更新！
            $data['regtime'] = date("Y-m-d H:i:s");
            if(!empty($post['sid'])){
                $data['sid'] = $post['sid'];
            }
            if(!empty($post['wx'])){
                $data['wx'] = $post['wx'];
            }
            if(!empty($post['info'])){
                $data['info'] = $post['info'];
            }
            if(!empty($post['intro'])){
                $data['intro'] = $post['intro'];
            }
            $avatar = $this->upload('avatar');
            if(!empty($avatar)){
                $data['avatar'] = '/uploads/' . $avatar;
            }
            //p($data);die;
            //更新档案
            if($this->profile_model->update_profile($this->session->uid, $data) === FALSE) {
                success('admin/profile/index', '档案更新失败');
            }else{
                success('admin/profile/index', '档案更新成功', true);
            }
        } else {
            //表单验证不通过 继续填写表单
            $this->edit();
        }
    }

    public function h5_upload()
    {
        $data['is_school'] = 'no';
        $this->load->view('admin/h5_avatar',$data);
    }

    /**
     * 更新头像
     */
    public function update_avatar($avatar = ''){
        //验证通过
        if(!empty($avatar) && stripos($avatar, '.jpg') != false){
            $this->load->model('profile_model');
            //$data for update
            $data['regtime'] = date("Y-m-d H:i:s");
            if(!empty($avatar)){
                $data['avatar'] = $avatar;
            }
            //p($data);die;
            //更新头像
            return $this->profile_model->update_profile($this->session->uid, $data);
        } else {
            return false;
        }
    }

    public function h5_upload_avatar()
    {
        //裁剪后的jpg头像
        $config['upload_path'] = './uploads/' . date('Y/m/d/');
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '1024'; //1024KB = 1MB
        $config['file_name'] = time() . '_' . mt_rand(1,9999);
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);
        }
        $this->load->library('upload', $config);
        //执行上传
        if( !$this->upload->do_upload('files')){ //name=files
            die('failed');
        }
        $error = $this->upload->display_errors();
        if($error) {
            die(strip_tags($error));
        }
        //返回信息
        $info = $this->upload->data();
        //echo json_encode($info, JSON_PRETTY_PRINT);exit;
        $winPath = str_ireplace('\\', '/', FCPATH);
        $avatar_path = str_ireplace($winPath, '', '/'.$info['full_path']);
        if($this->update_avatar($avatar_path)){
            echo 'success';
        }else{
            echo 'failed';
        }
    }

    //文件上传，返回文件名
    private function upload($name)
    {
        if(empty($name))
            return '';
        //文件上传------------------------
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2560';
        $config['file_name'] = time() . mt_rand(1000,9999);
        //载入上传类
        $this->load->library('upload', $config);
        //执行上传
        if( ! $this->upload->do_upload($name) ){
            return '';
        }
        //返回信息
        $info = $this->upload->data();



        $this->load->library('image_lib');
        list($width, $height) = getimagesize($info['full_path']);
        $config['image_library'] = 'gd2';
        $config['source_image'] = $info['full_path'];
        $config['maintain_ratio'] = FALSE;
        if($width >= $height)
        {
            $config['master_dim'] = 'height';
        }else{
            $config['master_dim'] = 'width';
        }
        $config['width'] = 300;
        $config['height'] = 400;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        /*
        $config['maintain_ratio'] = FALSE;
        if($width >= $height)
        {
            $config['x_axis'] = floor(($width * 300 / $height - 400)/2);
        }else{
            $config['y_axis'] = floor(($height * 400 / $width - 300)/2);
        }
        $config['x_axis'] = 'auto';
        $this->image_lib->initialize($config);
        $this->image_lib->crop();
        */



        return $info['file_name'];
    }
}