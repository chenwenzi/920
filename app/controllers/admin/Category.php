<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller{
    /**
     * 构造函数
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('category_model', 'cate');
    }
    /**
     * 查看栏目
     */
    public function index(){

        $data['category'] = $this->cate->check();
        $this->load->view('admin/cate', $data);
    }
    /**
     * 添加栏目
     */
    public function add_cate(){
        if(!$this->session->is_admin){
            error('没有权限添加分类');
        }
        // $this->output->enable_profiler(TRUE);
        $this->load->helper('form');
        $this->load->view('admin/add_cate');
    }

    /**
     * 添加动作
     */
    public function add(){

        if(!$this->session->is_admin){
            error('没有权限添加分类');
        }

        $this->load->library('form_validation');
        $status = $this->form_validation->run('cate');

        if($status){
            // echo "数据库操作";
            // echo $_POST['abc'];die;
            // var_dump($this->input->post('abc'));die;

            $data = array(
                'cname'	=> $this->input->post('cname')
            );

            $this->cate->add($data);
            success('admin/category/index', '添加成功');
        } else {
            $this->load->helper('form');
            $this->load->view('admin/add_cate');
        }
    }

    /**
     * 编辑
     */
    public function edit(){

        if(!$this->session->is_admin){
            error('没有权限编辑分类');
        }

        $cid = $this->uri->segment(4);
        // echo $cid;die;

        $data['category'] = $this->cate->check_cate($cid);

        $this->load->helper('form');
        $this->load->view('admin/edit_cate', $data);
    }


    /**
     * 编辑动作
     */
    public function do_edit(){

        if(!$this->session->is_admin){
            error('没有权限编辑分类');
        }

        $this->load->library('form_validation');
        $status = $this->form_validation->run('cate');

        if($status){

            $cid = $this->input->post('cid');
            $cname = $this->input->post('cname');

            $data = array(
                'cname'	=> $cname
            );

            $data['category'] = $this->cate->update_cate($cid, $data);
            success('admin/category/index', '修改成功');
        } else {
            $this->load->helper('form');
            $this->load->view('admin/edit_cate');
        }
    }


    /**
     * 删除栏目
     */
    public function del(){
        error('没有权限删除分类');
        $cid = $this->uri->segment(4);
        $this->cate->del($cid);
        success('admin/category/index', '删除成功');
    }








}