<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();

        if(empty($this->session->username) || empty($this->session->uid)) {
            redirect('/home/index');
            return;
        }
    }
}