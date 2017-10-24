<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 文章管理模型
 */
class Article_model extends CI_Model{
    /**
     * 发表文章
     */
    public function add($data){

        $this->db->insert('article', $data);
        return $this->db->insert_id();
    }

    /**
     * 检查参赛作品数量， 未删除的限制5个
     */
    public function article_limit(){
        $count = $this->db->where(['uid'=>$this->session->uid,'cid'=>1,'del_flag'=>0])->count_all_results('article');
        return $count > 5;
    }

    /**
     * 投票+1 仅给参赛分类 && 参赛作品投票 && 未删除
     */
    public function article_vote($id = ''){
        if(empty($id))
            return 2;
        $this->db->set('vote', 'vote+1', FALSE);
        $this->db->where(['id' => (int)$id, 'cid'=>1, 'isvote'=>1, 'del_flag'=>0]);
        $this->db->update('article');
        return $this->db->affected_rows();
    }

    /**
     * 如果当前作品设为参赛，该作者的其他要取消参赛
     */
    public function set_vote_article($curr_id) {
        //条件：该用户 && 非当前作品 && 当前分类是cid=1
        $this->db->where(['uid'=>$this->session->uid, 'id <>'=>$curr_id, 'cid'=>1]);
        return $this->db->update('article', ['isvote'=>0]);
    }

    /**
     * update_article
     *
     * 更新文章
     *
     * @param  int  $article_id
     * @param  array  $data
     * @access public
     * @return  mixed
     */
    public function update_article($article_id, $data) {
        //防止编辑，删除别人的文章
        if(!$this->session->is_admin){
            $this->db->where(['id' => $article_id, 'uid'=>$this->session->uid]);
        }else{
            $this->db->where(['id' => $article_id]);
        }
        return $this->db->update('article', $data);
    }

    /**
     * 后台作品列表， 排序: 参赛 > 发布时间
     */
    public function article_category($orderBy = '', $direction = ''){
        //admin or user
        $where['article.del_flag'] = 0;
        if(!$this->session->is_admin) {
            $where['article.uid'] = $this->session->uid;

            return $this->db->select('id,title,article.cid,vote,isvote,cname,add_time,username')->from('article')->join('category', 'article.cid=category.cid')->join('admin', 'article.uid=admin.uid')->where($where)->order_by('article.cid','asc')->order_by('article.id', 'desc')->get()->result_array();
        }

        //自定义排序
        if(!empty($orderBy) && !empty($direction)){
            return $this->db->select('article.id,article.title,article.cid,article.vote,article.isvote,cname,article.add_time,username')->from('article')->join('category', 'article.cid=category.cid')->join('admin', 'article.uid=admin.uid')->where($where)->order_by($orderBy,$direction)->get()->result_array();
        }

        //票数排序查看 默认
        return $this->db->select('article.id,article.title,article.cid,article.vote,article.isvote,cname,article.add_time,username')->from('article')->join('category', 'article.cid=category.cid')->join('admin', 'article.uid=admin.uid')->where($where)->order_by('article.vote','desc')->order_by('article.cid','asc')->order_by('article.id', 'desc')->get()->result_array();

    }

    /**
     * 后台用户列表， 排序: 个人票数 > 发布时间
     */
    public function p_list($orderBy = 'p.vote,p.regtime', $direction = 'desc'){
        //票数排序查看
        return $this->db->select('p.id,p.title,p.avatar,p.sid,p.vote,p.regtime,s.title stitle')->from('profile p')->join('school s', 'p.sid=s.id')->order_by($orderBy,$direction)->get()->result_array();
    }

    /**
     * 后台用户列表，
     */
    public function s_list(){
        return $this->db->select('id,title,avatar,regtime')->from('school')->order_by('regtime','desc')->get()->result_array();
    }


    /**
     *  作品列表， 只选择分类是作品的， 去除助威等其他分类， 并且是参赛的，未删除的
     */
    public function article_list(){
        $where = ['isvote'=>1,'del_flag'=>0,'cid'=>1];
        return $this->db->select('id,imgs,vote,title,intro')->order_by('add_time', 'desc')->get_where('article', $where)->result_array();
    }

    /**
     * 个人档列表
     */
    public function profile_list($teacher_name = null, $limit = 15, $offset = 0){
        //搜索功能
        if(!empty($teacher_name)){
            return $this->db->select('id,title,avatar,vote')->like('title', $teacher_name)->limit($limit, $offset)->order_by('regtime','desc')->order_by('convert(title using gbk) collate gbk_chinese_ci', 'asc')->get_where('profile')->result_array();
        }
        return $this->db->select('id,title,avatar,vote')->limit($limit, $offset)->order_by('regtime','desc')->order_by('convert(title using gbk) collate gbk_chinese_ci', 'asc')->get_where('profile')->result_array();
    }

    /**
     * 统计用户总数, 用户分页
     */
    public function profile_count($search = ''){
        if(!empty($search)){
            return $this->db->like('title', $search)->count_all_results('profile');
        }
        return $this->db->count_all('profile');
    }
    /**
     * 通过栏目调取文章
     */
    public function category_article($cid){
        $data = $this->db->select('id,imgs,title,intro')->order_by('add_time', 'desc')->get_where('article', array('cid'=>$cid,'del_flag'=>0))->result_array();
        return $data;
    }


    /**
     * 通过id调取文章
     */

    public function get_article($article_id){
        return $this->db->join('category', 'article.cid=category.cid')->get_where('article', array('id'=>$article_id,'del_flag'=>0))->row_array();
    }
    /**
     * 通过id 调取文章
     */

    public function get_author($article_id){
        return $this->db->select('admin.username')->join('admin', 'admin.uid=article.uid')->get_where('article', array('id'=>$article_id,'del_flag'=>0))->row_array();
    }

    /**
     * 判断是否是普通用户自己的文章
     * @param $aid 文章id
     * @return int
     */

    public function article_editable($id){
        $where = array(
            'id' => $id,
            'del_flag' => 0,
        );
        if( !$this->session->is_admin ){
            $where['uid'] = $this->session->uid;
        }
        return $this->db->where($where)->count_all_results('article');
    }










}