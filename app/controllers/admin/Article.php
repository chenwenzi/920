<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller{


    public function __construct(){
        parent::__construct();

        if((int)$this->session->user_type == 2){
            //error('只有教师才可以发布作品！');
        }
    }
    /**
     * 查看文章
     */
    public function index(){
        //后台设置后缀为空，否则分页出错
        $this->config->set_item('url_suffix', '');
        //载入分页类
        $this->load->library('pagination');
        $perPage = 15;

        //配置项设置
        $config['base_url'] = site_url('admin/article/index');
        if($this->session->is_admin){
            //$config['total_rows'] = $this->db->count_all('article');
            $config['total_rows'] = $this->db->where(array('del_flag'=>0))->count_all_results('article');
        }else{
            $config['total_rows'] = $this->db->where(array('uid'=>$this->session->uid,'del_flag'=>0))->count_all_results('article');
        }

        $config['per_page'] = $perPage;
        $config['uri_segment'] = 4;
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();
        //p($data);die;
        $offset = $this->uri->segment(4);
        $this->db->limit($perPage, $offset);

        $this->load->model('article_model');

        //orderby start
        $order = [
            'v' => 'article.vote',
            'a' => 'article.add_time',
            'id' => 'article.id',
            'default' => '',
        ];
        $direct = [
            'desc' => 'desc',
            'asc' => 'asc',
            'default' => '',
        ];
        $o = $this->input->get('orderby');
        $orderBy = !empty($order[$o]) ? $o : 'default';
        $d = $this->input->get('direct');
        $direction = !empty($direct[$d]) ? $d : 'default';
        //for template
        $data['redirection'] = $direction=='asc' ? 'desc' : 'asc';
        //oderby end

        $data['article'] = $this->article_model->article_category($order[$orderBy], $direct[$direction]);
        //p($config);
        //p($data);die;
        $this->load->view('admin/article_list', $data);
    }

    //用户信息管理
    //profile or school
    public function userlist($tb = 'profile'){
        //$this->output->enable_profiler(TRUE);
        if(!$this->session->is_admin) {
           error('权限不足！');
        }
        //后台设置后缀为空，否则分页出错
        $this->config->set_item('url_suffix', '');
        //载入分页类
        $this->load->library('pagination');
        $perPage = 15;

        //配置项设置
        $config['base_url'] = $tb == 'profile' ? site_url('admin/article/userlist/profile') : site_url('admin/article/userlist/school');
        if($this->session->is_admin){
            $config['total_rows'] = $tb == 'profile' ? $this->db->count_all('profile') : $this->db->count_all('school');
        }else{
            $config['total_rows'] = $tb == 'profile' ? $this->db->where(array('uid'=>$this->session->uid))->count_all_results('profile') : $this->db->where(array('uid'=>$this->session->uid))->count_all_results('school');
        }

        $config['per_page'] = $perPage;
        $config['uri_segment'] = 5;
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();
        //p($data);die;
        $offset = $this->uri->segment(5);
        $this->db->limit($perPage, $offset);

        $this->load->model('article_model');
        $data['hide'] = $tb == 'profile' ? '' : ' style="display:none"';
        $data['tb'] = $tb;

        //orderby start
        $order = [
            'vr' => 'p.vote,p.regtime',
            'r' => 'p.regtime',
            'id' => 'p.id',
            't'  => 'convert(p.title using gbk) collate gbk_chinese_ci'
        ];
        $direct = [
            'desc' => 'desc',
            'asc' => 'asc',
        ];
        $o = $this->input->get('orderby');
        $orderBy = !empty($order[$o]) ? $o : 'vr';
        $d = $this->input->get('direct');
        $direction = !empty($direct[$d]) ? $d : 'desc';
        //for template
        $data['redirection'] = $direction=='asc' ? 'desc' : 'asc';
        //oderby end

        $data['userList'] = $tb == 'profile' ? $this->article_model->p_list($order[$orderBy], $direct[$direction]) : $this->article_model->s_list();

        //p($data);die;
        $this->load->view('admin/user_list', $data);

    }
    /**
     * 发表文章模板显示
     */
    public function news(){

        if($this->session->is_admin){
            //error('管理员bie闹，你不能发布作品！');
        }
        $this->load->model('category_model');
        $data['category'] = $this->category_model->check();

        $this->load->helper('form');
        if((int)$this->session->user_type == 2){//学校 助威
            $this->load->view('admin/new_article_school', $data);
        }else {//教师
            $this->load->view('admin/new_article', $data);
        }
    }

    /**
     * 发表文章动作
     */
    public function send(){

        $cate_id = (int)$this->input->post('cid');
        $this->load->model('article_model');
        if($cate_id==1 && $this->article_model->article_limit()){
            error('每用户最多可以发布5篇[参赛作品]\r发布[其他作品]试试吧');
        }
        //载入表单验证类
        $this->load->library('form_validation');

        if( $cate_id == 3 || $cate_id == 4){
            $status = $this->form_validation->run('article_kj');
        }else{
            $status = $this->form_validation->run('article');
        }


        if($status){
            $desc = htmlspecialchars_decode($this->input->post('content'));
            $desc = str_ireplace('支持上传图片哦，单个图片小于2M！','',$desc);
            /*$desc = preg_replace('/<br\s*?\/*?>/i','', $desc);*/
            $intro = strip_tags($desc);
            $data = array(
                'title'	=> $this->input->post('title'),
                //'type'	=> $this->input->post('type'),
                'cid'	=> $cate_id,//1作品 2助威 3课程 4教案
                'uid' => $this->session->uid,
                'add_time'	=> date("Y-m-d H:i:s")
            );
            switch ((int)$data['cid']){
                case 1://参赛作品
                    $data['imgs'] = json_encode($this->get_images($desc));
                    $data['content'] = $desc;
                    $data['intro'] = mb_substr($intro, 0, 64);
                    $data['video'] = $this->input->post('video');
                    $data['isvote'] = $this->input->post('isvote');
                    break;
                case 2://助威
                    $data['video'] = $this->input->post('video');
                    $data['isvote'] = '0';
                    break;
                case 3://教程
                case 4://教案
                    $data['imgs'] = json_encode($this->get_images($desc));
                    $data['content'] = $desc;
                    $data['intro'] = mb_substr($intro, 0, 64);
                    $data['isvote'] = '0';
                    break;
                default:
            }
            //p($data);die;
            $lastId = $this->article_model->add($data);
            //该作品参赛 && 是参赛分类
            if((int)$data['isvote'] == 1 && (int)$data['cid'] == 1){
                $this->article_model->set_vote_article($lastId);
            }
            success('admin/article/index', '发表成功', true);
        }else {
            $this->news();
        }
    }

    /**
     * 编辑文章
     */
    public function edit($id){
        if(empty($id))
            return;
        $this->load->model('article_model');
        //不是普通用户自己的文章
        if(empty($this->article_model->article_editable($id))){
            error('不能编辑别人的作品');
        }
        $this->load->model('category_model');
        $data = [
            'ar'    => $this->article_model->get_article($id),
            'cate'  => $this->category_model->check(),
        ];
        $this->load->helper('form');
        $this->load->view('admin/edit_article', $data);
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
    /**
     * 编辑动作
     */
    public function do_edit( $article_id ){

        $this->load->library('form_validation');
        $status = $this->form_validation->run('article_edit');

        if($status && !empty($article_id)){
            $this->load->model('article_model');
            $desc = htmlspecialchars_decode($this->input->post('content'));
            $desc = str_ireplace('支持上传图片哦，单个图片小于2M！','',$desc);
            /*$desc = preg_replace('/<br\s*?\/*?>/i','', $desc);*/
            $intro = strip_tags($desc);

            $data = array(
                'title'     => $this->input->post('title'),
                //'type'    => $this->input->post('type'),
                //'cid'       => $this->input->post('cid'), //不允许修改作品类型
                'isvote'    => $this->input->post('isvote'),
                'video'     => $this->input->post('video'),
                'intro'     => mb_substr($intro, 0, 64),
                'content'   => $desc,
                'add_time'  => date("Y-m-d H:i:s")
            );
            //视频不为空时更新
            if(empty($data['video'])){
                unset($data['video']);
            }
            //预览图片不为空
            $imgs = $this->get_images($desc);
            if(!empty($imgs)){
                $data['imgs'] = json_encode($imgs);
            }
            //p($data);die;
            if($this->article_model->update_article($article_id, $data) === FALSE) {
                success('admin/article/index', '更新失败');
            }else{
                if($data['isvote'] == 1){
                    $this->article_model->set_vote_article($article_id);
                }
                success('admin/article/index', '更新成功', true);
            }
        } else {
            $this->edit($article_id);
        }
    }

    /**
     * 放到回收站
     */
    public function del( $article_id ){

        if(!empty($article_id)){

            $this->load->model('article_model');
            //不是普通用户自己的文章
            if(empty($this->article_model->article_editable($article_id))){
                error('不能删除别人的作品');
            }
            $data['del_flag'] = 1;
            if($this->article_model->update_article($article_id, $data) === FALSE) {
                success('admin/article/index', '删除失败');
            }else{
                success('admin/article/index', '删除成功', true);
            }
        } else {
            redirect('admin/article/index');
            return;
        }
    }

    //no use
    public function check_upload_pic()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2560000';
        $config['file_name'] = time() . mt_rand(1000,9999);
        $this->load->library('upload', $config);
        //上传图片处理
        if ( ! $this->upload->do_upload('thumb'))
        {
            $this->form_validation->set_message('check_upload_pic', $this->upload->display_errors());
            return false;
        } else {
            return true;
        }
    }

    function check_exists(){
        exit('0');
    }
    /*
    UploadiFive
    */
    function upload_video(){
        set_time_limit(500);

        $config['upload_path'] = FCPATH . 'uploads/video/'.date('Y') . '/' . date('md') . '/';
        $config['allowed_types'] = 'mov|mp4|flv';
        $config['max_size'] = '51200'; //51200KB
        $config['file_name'] = time() .'_'. mt_rand(1,9999);

        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);

        }
        //载入上传类
        $this->load->library('upload', $config);

        //执行上传
        $this->upload->do_upload('Filedata');
        $wrong = $this->upload->display_errors();
        if($wrong) {
            die(strip_tags($wrong));
        }
        //返回信息
        $info = $this->upload->data();
        //echo json_encode($info, JSON_PRETTY_PRINT);exit;
        $winPath = str_ireplace('\\', '/', FCPATH);
        echo 'success,' . str_ireplace($winPath, '', '/'.$info['full_path']);
    }

    //no use
    function uploads($name){
        if(empty($name))
            return 'default.png';
        //文件上传------------------------
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2560000';//2.5M
        $config['file_name'] = time() . mt_rand(1000,9999);
        //载入上传类
        $this->load->library('upload', $config);
        //执行上传
        $this->upload->do_upload($name);
        $wrong = $this->upload->display_errors();
        if($wrong){
            error($wrong);
        }
        //返回信息
        $info = $this->upload->data();
        //缩略图-----------------
        //配置
        $arr['source_image'] = $info['full_path'];
        $arr['create_thumb'] = FALSE;
        $arr['maintain_ratio'] = TRUE;
        $arr['width'] = 200;
        $arr['height'] = 200;

        //载入缩略图类
        $this->load->library('image_lib', $arr);
        //执行动作
        $status = $this->image_lib->resize();

        if(!$status){
            return 'default.png';
            //error('缩略图动作失败');
        }
        return $info['file_name'];
    }
}