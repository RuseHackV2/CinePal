<?php

/**
 * Created by PhpStorm.
 * User: Krasio
 * Date: 7.11.2015 г.
 * Time: 11:17 ч.
 */
class LogInController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('session');
    }

    public function login()
    {
        $this->load->helper('url');
        $this->load->helper('our');
        $data = array();

        $page = $this->load->view('homepage',$data,true);
        $this->load->view('skeleton',array('page'=>$page));
    }


}