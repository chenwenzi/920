<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends MY_Controller{
    /**
     * 个人档
     */
    public function index(){

        $this->load->model('school_model');
        $data['school'] = $this->school_model->get_my_school();
        //p($data);die;
        $this->load->view('admin/school', $data);
    }
    /**
     * 发表文章模板显示
     */
    public function news(){
        $this->load->model('school_model');
        $data = [
            'teachers' => $this->school_model->get_my_teacher(),
            'schools' => $this->school_model->get_all_school(),
        ];
        $this->load->helper('form');
        $this->load->view('admin/new_school', $data);
    }



    public function check_upload_pic()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000';
        $config['file_name'] = time() . mt_rand(1000,9999);
        $this->load->library('upload', $config);
        //上传图片处理
        if ( ! $this->upload->do_upload('avatar'))
        {
            $this->form_validation->set_message('check_upload_pic', $this->upload->display_errors());
            return false;
        }
        else
        {
            return true;
        }
    }
    /**
     * 发表文章动作 ****** 不用了 初始化进去数据
     */
    public function add(){

        $this->load->model('school_model');
        if($this->school_model->have_profile()){
            $this->do_edit();
            return;
        }

        //载入表单验证类
        $this->load->library('form_validation');
        $status = $this->form_validation->run('school');

        if($status){
            $desc = htmlspecialchars_decode($this->input->post('intro'));
            $desc = str_ireplace('支持上传图片哦，单个图片小于2M！','',$desc);
            $data = array(
                'uid'      => $this->session->uid,
                'title'    => $this->session->username,
                'avatar'   => $this->upload('avatar'),
                'imgs'     => json_encode($this->get_images($desc)),

                //'sid'      => $this->input->post('sid'),
                'wx'       => $this->input->post('wx'),
                'wx_qr'    => $this->input->post('wx_qr'),
                //'info'     => $this->input->post('info'),
                'intro'    => $desc,
                'more'     => '',
                'regtime'  => date("Y-m-d H:i:s"),

                'tel'      => $this->input->post('tel'),
                'contact'      => $this->input->post('contact'),
                'address'      => $this->input->post('address'),
                'good_teacher'      => $this->input->post('good_teacher'),
                'relate_sid'      => $this->input->post('relate_sid'),
            );
            //p($data);die;
            $this->school_model->add($data);
            success('admin/school/index', '添加成功');
        }else {
            $this->news();
        }
    }

    /**
     * 编辑文章
     */
    public function edit($id = null){
        //$this->output->enable_profiler(TRUE);
        $this->load->model('school_model');
        $data = [
            'school'     => $this->school_model->get_school(),
            'teachers' => $this->school_model->get_my_teacher(),
            'schools' => $this->school_model->get_all_school(),
        ];
        //p($data);return;
        $this->load->helper('form');
        $this->load->view('admin/edit_school', $data);
    }


    /**
     * 编辑动作
     */
    public function do_edit(){

        //$this->load->library('form_validation');
        //$status = $this->form_validation->run('school_eidt');

        if($this->input->post('edit')){
            $this->load->model('school_model');
            $desc = htmlspecialchars_decode($this->input->post('intro'));
            $desc = str_ireplace('支持上传图片哦，单个图片小于2M！','',$desc);
            $data = array(
                //'sid'      => $this->input->post('sid'),
                'wx'       => $this->input->post('wx'),
                //'wx_qr'    => $this->input->post('wx_qr'),
                //'info'     => $this->input->post('info'),
                'imgs'     => json_encode($this->get_images($desc)),
                'more'     => '',
                'intro'    => $desc,
                'regtime'     => date("Y-m-d H:i:s"),

                'tel'      => $this->input->post('tel'),
                'contact'      => $this->input->post('contact'),
                'address'      => $this->input->post('address'),
                'good_teacher'      => $this->input->post('good_teacher'),
            );
            //选择了联战校区， 或取消选择了全部等
            $relate_sid = $this->input->post('relate_sid');
            $data['relate_sid'] = '';
            if(!empty($relate_sid)){
                $data['relate_sid'] = json_encode($relate_sid);
            }
            //图片为空不更新
            $avatar = $this->upload('avatar');
            if(!empty($avatar)){
                $data['avatar'] = '/uploads/' . $avatar;
            }
            /*
            $imgs = $this->upload('imgs');
            if(!empty($imgs)){
                $data['imgs'] = '/uploads/' . $imgs;
            }
            */
            if(!empty($info['file_name'])){
                $data['imgs'] = $info['file_name'];
            }
            //p($data);die;
            //print_r($data);die;
            if($this->school_model->update_school($this->session->uid, $data) === FALSE) {
                success('admin/school/index', '档案更新失败');
            }else{
                success('admin/school/index', '档案更新成功', true);
            }
        } else {
            success('admin/school/edit', '档案填写不完整');
        }
    }

    /**
     * 放到回收站
     */
    public function del(){

        error('不能删除学校档案');
    }

    private function upload($name)
    {
        if(empty($name))
            return '';
        //文件上传------------------------
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000';
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
        $config['width'] = 380;
        $config['height'] = 320;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        /*
        $config['maintain_ratio'] = FALSE;
        if($width >= $height)
        {
            $config['x_axis'] = floor(($width * 380 / $height - 320)/2);
        }else{
            $config['y_axis'] = floor(($height * 320 / $width - 380)/2);
        }
        $this->image_lib->initialize($config);
        $this->image_lib->crop();
        */


        return $info['file_name'];
    }

    //find imgs in article @wenzi
    public function get_images( $content = '' ) {
        if(empty($content)){
            return false;
        }

        $imgs = array();
        if ( preg_match_all( '/<img [^>]+>/i', $content, $matches ) ) {

            foreach ( (array) $matches[0] as $image ) {
                //imgs
                if ( ! preg_match( '/src="([^"]+)"/i', $image, $url_matches ) ) {
                    continue;
                }

                $image_src = $url_matches[1];

                // Don't try to sideload a file without a file extension, leads to WP upload error.
                if ( ! preg_match( '/[^\?]+\.(?:jpe?g|jpe|gif|png)(?:\?|$)/i', $image_src ) ) {
                    continue;
                }

                //a new image src.
                array_push($imgs, $image_src);
            }
        }

        return $imgs;
    }


    public function h5_upload()
    {
        $data['is_school'] = 'yes';
        $this->load->view('admin/h5_avatar',$data);
    }

    /**
     * 更新头像
     */
    public function update_avatar($avatar = ''){
        //验证通过
        if(!empty($avatar) && stripos($avatar, '.jpg') != false){
            $this->load->model('school_model');
            //$data for update
            $data['regtime'] = date("Y-m-d H:i:s");
            if(!empty($avatar)){
                $data['avatar'] = $avatar;
            }
            //p($data);die;
            //更新头像
            return $this->school_model->update_school($this->session->uid, $data);
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

}