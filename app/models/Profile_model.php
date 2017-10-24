<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 文章管理模型
 */
class Profile_model extends CI_Model{
    /**
     * 发表文章
     */
    public function add($data){

        $this->db->insert('profile', $data);
    }

    /**
     * update_profile
     *
     * 更新文章
     *
     * @param  int  $profile_id
     * @param  array  $data
     * @access public
     * @return  mixed
     */
    public function update_profile($profile_id, $data) {
        $this->db->where('uid', $profile_id);
        return $this->db->update('profile', $data);
    }

    /**
     * 学校列表
     */
    public function get_school(){
        return $this->db->select('id,title')->get_where('school')->result_array();
    }

    /**
     * pid, sid
     */
    public function get_who_id(){
        if((int)$this->session->user_type == 2){
            return $this->db->select('id')->get_where('school',['school.uid'=>$this->session->uid])->row_array();
        }else{
            return $this->db->select('id')->get_where('profile',['profile.uid'=>$this->session->uid])->row_array();
        }

    }

    /**
     * 投票+1 个人票
     */
    public function profile_vote($id = ''){
        if(empty($id))
            return 2;
        $this->db->set('vote', 'vote+1', FALSE);
        $this->db->where(['id' => (int)$id]);
        $this->db->update('profile');
        return $this->db->affected_rows();
    }

    /**
     * 查看资料 & 所属学校
     */
    public function get_profiles(){
        return $this->db->select('profile.*,school.title s_title,school.id s_id')->from('profile')->join('school','profile.sid=school.id')->where(['profile.uid'=>$this->session->uid])->get()->row_array();
    }

    /**
     * 是否已有资料
     */
    public function have_profile(){
        return $this->db->where(['uid'=>$this->session->uid])->count_all_results('profile');
    }

    /**
     * 右侧文章标题调取
     */
    public function title($limit){
        $data = $this->db->select('title,id')->order_by('add_time', 'desc')->limit($limit)->get_where('profile', array('del_flag'=>0))->result_array();
        return $data;
    }

    /**
     * 我的资料 & 所属校区
     */
    public function get_profile_by( $profile_id ){
        return $this->db->select('p.id,p.title,p.avatar,p.info,p.intro,p.sid,p.vote,s.title stitle')->from('profile p')->join('school s','s.id=p.sid')->where(array('p.id'=>$profile_id))->get()->row_array();
    }

    /**
     * 查询我的作品或助威... 通过 profile.id
     */
    public function get_my_article( $profile_id, $cate_id = 1 ){
        $order = 'a.id';
        if($cate_id == 1){
            //作品: 把参赛作品放在最前面
            $order = 'a.isvote';
        }
        return $this->db->select('a.id,a.title,a.imgs,a.video,a.vote,a.isvote')->from('article a')->join('profile p','p.uid=a.uid')->where(array('p.id'=>$profile_id,'a.cid'=>$cate_id,'a.del_flag'=>0))->order_by($order, 'desc')->get()->result_array();
    }


}