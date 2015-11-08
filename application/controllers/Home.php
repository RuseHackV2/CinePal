<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public  function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('our');
		$this->load->library('session');
		$this->load->model('UserModel','',true);
		$this->load->model('SearchCache','',true);
	}

	public function index()
	{

		$data = array();
		$data['disable_nav_search'] = true;
		if(isset($_SESSION['userid'])){
			$data['userid'] = $_SESSION['userid'];
			$this->UserModel->getById($_SESSION['userid']);
			$data['user'] = $this->UserModel;
		}
		$data['recent'] = $this->SearchCache->last(25);
		$data['popular'] = $this->SearchCache->popular(25);

		$page = $this->load->view('homepage',$data,true);
		$this->load->view('skeleton',array('page'=>$page));
	}

	public function login(){
		$data = array();
		//$data['userid'] = $_SESSION['userid'];
		$data['error'] = '';
		if($this->input->post('submit')){
			if(strlen($this->input->post('username',TRUE)) < 1 || strlen($this->input->post('password',TRUE)) < 1) {
				header('Location: '.site_url().'?loginerr=1');
			}
			elseif(!$this->UserModel->passwordAuthenticate($this->input->post('username',TRUE),$this->input->post('password',TRUE)))
				header('Location: '.site_url().'?loginerr=2');
			else{
				$_SESSION['userid'] = $this->UserModel->getId();
				header('Location: '.site_url());
			}
		}
	}

	public function logout(){
		unset($_SESSION['userid']);
		header('Location: '.site_url());
	}
}
