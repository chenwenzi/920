<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 文章管理模型
 */
class School_model extends CI_Model{
    /**
     * 发表文章
     */
    public function add($data){

        $this->db->insert('school', $data);
    }

    /**
     * update_school
     *
     * 更新文章
     *
     * @param  int  $school_id
     * @param  array  $data
     * @access public
     * @return  mixed
     */
    public function update_school($school_id, $data) {
        $this->db->where('uid', $school_id);
        return $this->db->update('school', $data);
    }

    /**
     * 是否已有资料
     */
    public function have_profile(){
        return $this->db->where(['uid'=>$this->session->uid])->count_all_results('school');
    }

    /**
     * 学校统计用户分页
     */
    public function school_count(){
        return $this->db->count_all('school');
    }
    /**
     * 学校列表
     */
    public function school_list($limit = 9, $offset = 0){
        return $this->db->select('id,title,avatar,intro')->order_by('regtime', 'desc')->order_by('id', 'asc')->limit($limit, $offset)->get_where('school')->result_array();
    }
    /**
     * 学校详情页
     */
    public function get_school(){
        return $this->db->select('*')->get_where('school', ['uid'=>$this->session->uid])->row_array();
    }

    /**
     * 学校详情页
     */
    public function get_school_by($school_id){
        return $this->db->select('*')->get_where('school', ['id'=>$school_id])->row_array();
    }

    /**
     * 校区联盟 获取校名
     */
    public function get_relate_school($school_ids_array = []){
        return $this->db->select('id,title,avatar')->from('school')->where_in('id', $school_ids_array)->get()->result_array();
    }



    /**
     * 学校详情页
     */
    public function get_my_school(){
        return $this->db->select('*')->get_where('school', ['uid'=>$this->session->uid])->row_array();
    }

    /**
     * 该学校所有的教师
     */
    public function get_my_teacher(){
        //return $this->db->select('id,title')->get_where('profile', ['sid'=>$this->session->uid])->result_array();
        return $this->db->select('profile.id,profile.title')->from('profile')->join('school','profile.sid=school.id')->where(['school.uid'=>$this->session->uid])->get()->result_array();
    }

    /**
     * 该学校所有的教师
     */
    public function get_teacher_by($school_id){
        return $this->db->select('id,title,avatar')->order_by('regtime','desc')->order_by('convert(title using gbk) collate gbk_chinese_ci', 'asc')->get_where('profile', ['sid'=>$school_id])->result_array();
        //return $this->db->select('profile.id,profile.title')->from('profile')->join('admin', 'profile.sid=admin.uid')->where($where)->order_by('profile.regtime','desc')->get()->result_array();

    }

    /**
     * 查询学校助威... 通过 school.id && 未删除
     */
    public function get_my_article($school_id, $cate_id = 2){
        return $this->db->select('a.id,a.title,a.video')->from('article a')->join('school s','s.uid=a.uid')->where(array('s.id'=>$school_id,'a.cid'=>$cate_id,'a.del_flag'=>0))->order_by('a.id', 'desc')->get()->result_array();
    }

    /**
     * 该学校所有的教师
     */
    public function get_all_school(){
        return $this->db->select('id,title')->get_where('school')->result_array();
    }

    /**
     * 右侧文章标题调取
     */
    public function title($limit){
        $data = $this->db->select('title,id')->order_by('add_time', 'desc')->limit($limit)->get_where('school', array('del_flag'=>0))->result_array();
        return $data;
    }



}