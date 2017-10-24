<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 默认前台控制器
 */
class Home extends CI_Controller{
    public $category;
    public $school;

    public function __construct(){
        parent::__construct();

        $this->load->model('article_model');
        $this->load->model('category_model');

        //$this->category = $this->category_model->limit_category(5);
        //array_push($this->category, ['cid'=>'/u','cname'=>'教师档']);
        //array_push($this->category, ['cid'=>'/s','cname'=>'学校档']);
        //p($this->category);die;
        //$this->school = $this->article_model->school_list(10);
    }
    /**
     * 默认首页显示方法
     */
    public function index(){
        //$this->output->enable_profiler(TRUE);
        // echo base_url() . 'style/index/';
        // echo site_url() . '/index/home/category';

        $data = [
            //'zuopin'  => $this->article_model->article_list(),
            //'profile' => $this->article_model->profile_list(),
        ];

        //p($data);die;
        $this->output->cache(5/60);
        $this->load->view('index/header');
        $this->load->view('index/home', $data);
        $this->load->view('index/footer');
    }

    /**
     * 分类页显示
     */
    public function category(){
        //$data['category'] = $this->category;
        //$data['title'] = $this->school;

        $cid = $this->uri->segment(2);
        $data['article'] = $this->article_model->category_article($cid);

        $this->load->view('index/category', $data);
    }


    /**
     * 作品页
     */
    public function article($id = null){
        //作品列表页
        if(empty($id)){
            $data = [
                'article' => $this->article_model->article_list(),
            ];
            //$data['category'] = $this->category;
            //$data['title'] = $this->school;
            $this->output->cache(5 / 60);
            $this->load->view('index/header');
            $this->load->view('index/article_list', $data);
            $this->load->view('index/footer');
        }else {
            //作品详情页
            //$this->output->enable_profiler(TRUE);
            //$aid = $this->uri->segment(2);

            //$data['category'] = $this->category;
            //$data['title'] = $this->school;
            $data['article'] = $this->article_model->get_article($id);
            $data['author'] = $this->article_model->get_author($id);
            //p($data);die;
            if (empty($data['article'])) {
                show_404();
                return;
            }
            $this->load->view('index/header');
            $this->load->view('index/article', $data);
            $this->load->view('index/footer');
        }
    }

    /**
     * 教师个人档
     */
    public function profile($profile_id = null, $page_num = 1){
        //个人列表页档
        if(empty($profile_id)) {
            //$this->output->enable_profiler(TRUE);
            //搜索功能
            $teacher_name = $this->input->get('q');
            //分页
            $this->config->set_item('url_suffix', '');
            $this->load->library('pagination');
            $perPage = 15;
            //分页配置
            $config['base_url'] = site_url('/u/p');
            $config['total_rows'] = $this->article_model->profile_count($teacher_name);
            //p($config);die;
            $config['per_page'] = $perPage;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<ul>';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
            $config['first_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_link'] = '&laquo;';
            $config['next_link'] = '&raquo;';
            $config['last_link'] = false;
            $config['first_link'] = false;
            //$config['first_url'] = '/u';
            $config['num_links'] = 4;
            $this->pagination->initialize($config);
            $data['links'] = $this->pagination->create_links();
            // p($data);die;
            $max_page = ceil($config['total_rows'] / $perPage);
            $cur_page = (int)$page_num > 1 && (int)$page_num <= $max_page ? (int)$page_num : 1;
            $offset = ($cur_page - 1) * $perPage;

            $data['profile'] = $this->article_model->profile_list($teacher_name, $perPage, $offset);
            //p($data);die;
            $this->output->cache(5 / 60);
            $this->load->view('index/header');
            $this->load->view('index/profile_list', $data);
            $this->load->view('index/footer');
        }else{
            //个人档详情页
            //$this->output->enable_profiler(TRUE);
            $this->load->model('profile_model');
            $data['profile'] = $this->profile_model->get_profile_by($profile_id);
            $data['article'] = $this->profile_model->get_my_article($profile_id, 1);
            $data['cheer'] = $this->profile_model->get_my_article($profile_id, 2);
            $data['kc'] = $this->profile_model->get_my_article($profile_id, 3);
            $data['ja'] = $this->profile_model->get_my_article($profile_id, 4);

            //p($data);die;
            if(empty($data['profile'])){
                show_404();
                return;
            }

            //token 防刷票
            $data['token'] = $_SESSION['token'] = md5('unique_salt' . time());
            $data['itoken'] = $_SESSION['itoken'] = md5('unique_salt2' . time());

            $this->load->view('index/header');
            $this->load->view('index/profile', $data);
            $this->load->view('index/footer');
        }
    }

    /**
     * 学校档
     */
    public function school($school_id = null, $page_num = 1){
        $this->load->model('school_model');
        //学校档列表页档, 只有注册时间不为空的才是登陆过添加过资料的，其他为我们初始化的
        if(empty($school_id)) {
            //分页
            $this->config->set_item('url_suffix', '');
            $this->load->library('pagination');
            $perPage = 9;
            //分页配置
            $config['base_url'] = site_url('/s/p');
            $config['total_rows'] = $this->school_model->school_count();
            $config['per_page'] = $perPage;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<ul>';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
            $config['first_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_link'] = '&laquo;';
            $config['next_link'] = '&raquo;';
            $config['last_link'] = false;
            $config['first_link'] = false;
            //$config['first_url'] = '/s';
            $config['num_links'] = 4;
            $this->pagination->initialize($config);
            $data['links'] = $this->pagination->create_links();
            // p($data);die;
            $max_page = ceil($config['total_rows'] / $perPage);
            $cur_page = (int)$page_num > 1 && (int)$page_num <= $max_page ? (int)$page_num : 1;
            $offset = ($cur_page - 1) * $perPage;

            $data['school'] = $this->school_model->school_list($perPage, $offset);
            //p($data);die;
            $this->output->cache(5 / 60);
            $this->load->view('index/header');
            $this->load->view('index/school_list', $data);
            $this->load->view('index/footer');
        }else{
            //学校档详情页
            //$this->output->enable_profiler(TRUE);
            $this->load->model('school_model');
            $data['school'] = $this->school_model->get_school_by($school_id);
            $data['teachers'] = $this->school_model->get_teacher_by($school_id);
            $data['cheer'] = $this->school_model->get_my_article($school_id, 2);
            //default is empty
            $data['relate_school'] = array();
            if(!empty($data['school']['relate_sid'])) {
                $school_ids_array = json_decode($data['school']['relate_sid'], true);
                $data['relate_school'] = $this->school_model->get_relate_school($school_ids_array);
            }

            //p($data);die;
            if(empty($data['school'])){
                show_404();
                return;
            }
            $this->load->view('index/header');
            $this->load->view('index/school', $data);
            $this->load->view('index/footer');
        }
    }

    public function output_json($data = []){
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
    /**
     * like_count 作品点赞操作
     *
     * 点赞操作
     *
     * @access public
     * @param   int  $article_id
     * @return  void
     */
    public function like($id = 0) {

        if(time() < strtotime('2017-09-04')){
            $this->output_json(['code'=>1, '_msg'=>'点赞未开始！']);
            return;
        }
        if(time() >= strtotime('2017-09-10')){
            $this->output_json(['code'=>1, '_msg'=>'点赞已结束！']);
            return;
        }

        $this->load->library('user_agent');
        // 防机刷(对头信息伪造无解)
        if ( ! $this->agent->is_browser() &&  ! $this->agent->is_mobile()) {
            return;
        }

		if(empty($id)){
            $this->output_json(['code'=>1, '_msg'=>'未找到参赛作品！']);
            return;
        }
        //token  防刷
        if(empty($_SESSION['token'] )){
            $this->output_json(['code'=>1, '_msg'=>'已经赞过啦！']);
            return;
        }
        if($this->input->get('token') != $_SESSION['token']){
            $this->output_json(['code'=>1, '_msg'=>'投票失败了！']);
            return;
        }
        unset($_SESSION['token']);
        $_SESSION['token'] = null;

        $this->load->driver('cache');

        // 缓存创建
        $cache_name = $this->input->ip_address().'_like';

        // 是否存在缓存
        if( !$this->cache->file->get($cache_name) ) {

            // 更新点赞数
            $res = $this->article_model->article_vote($id);

            switch ($res){
                case 0:
                    $this->output_json(['code'=>1, '_msg'=>'未找到参赛作品！']);
                    break;
                case 1:
                    $this->output_json(['code'=>0, '_msg'=>'点赞成功！']);
                    // 缓存未过期不得刷访问
                    // 过期时间设置：衡量访问量和访问限制(IP并发数量多要调小，否则会出现大量文件)
                    $this->cache->file->save($cache_name, time(), 3600*12);
                    break;
                case 2:
                    $this->output_json(['code'=>1, '_msg'=>'没有参赛作品！']);
                    break;
                default:
                    $this->output_json(['code'=>1, '_msg'=>'点赞失败！']);
            }
            return;
        }

        $this->output_json(['code'=>1, '_msg'=>'你已经赞过啦！']);
        return;
    }

    /**
     * like_count 教师本人点赞操作
     *
     * 点赞操作
     *
     * @access public
     * @param   int  $profile_id
     * @return  void
     */
    public function likeu($id = 0) {

        if(time() < strtotime('2017-09-04')){
            $this->output_json(['code'=>1, '_msg'=>'投票未开始！']);
            return;
        }
        if(time() >= strtotime('2017-09-10')){
            $this->output_json(['code'=>1, '_msg'=>'投票已结束！']);
            return;
        }

        //token  防刷
        if(empty($_SESSION['itoken'] )){
            $this->output_json(['code'=>1, '_msg'=>'已经投过票啦！']);
            return;
        }
        if($this->input->get('itoken') != $_SESSION['itoken']){
            $this->output_json(['code'=>1, '_msg'=>'投票失败了！']);
            return;
        }
        unset($_SESSION['itoken']);
        $_SESSION['itoken'] = null;

        $this->load->library('user_agent');
        // 防机刷(对头信息伪造无解)
        if ( ! $this->agent->is_browser() &&  ! $this->agent->is_mobile()) {
            return;
        }

        $this->load->driver('cache');

        // 缓存创建
        $cache_name = $this->input->ip_address().'_likeu';

        // 是否存在缓存
        if( !$this->cache->file->get($cache_name) ) {

            $this->load->model('profile_model');
            // 更新点赞数
            $res = $this->profile_model->profile_vote($id);

            switch ($res){
                case 0:
                    $this->output_json(['code'=>1, '_msg'=>'教师不存在！']);
                    break;
                case 1:
                    $this->output_json(['code'=>0, '_msg'=>'投票成功！']);
                    // 缓存未过期不得刷访问
                    // 过期时间设置：衡量访问量和访问限制(IP并发数量多要调小，否则会出现大量文件)
                    $this->cache->file->save($cache_name, time(), 3600*12);
                    break;
                case 2:
                    $this->output_json(['code'=>1, '_msg'=>'教师不存在！']);
                    break;
                default:
                    $this->output_json(['code'=>1, '_msg'=>'投票失败！']);
            }
            return;
        }

        $this->output_json(['code'=>1, '_msg'=>'你已经投过票啦！']);
        return;
    }

}