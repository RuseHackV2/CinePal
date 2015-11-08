<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-08
 * Time: 8:50 AM
 */

include (APPPATH.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'REST_Controller.php');

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('our');
        $this->load->library('session');
        $this->load->model('OMDBModel');
        $this->load->model('UserModel','',true);
    }

    public function index(){
        //nothing?
    }

    public function preferences_get(){
        $data = array();
        $data['title'] = 'Preferences';
        if(isset($_SESSION['userid'])) {
            $data['userid'] = $_SESSION['userid'];
            $this->UserModel->getById($_SESSION['userid']);
            $data['user'] = $this->UserModel;
            $data['movies'] = array();
            if(is_array($this->UserModel->getPreferences())){
                foreach($this->UserModel->getPreferences() as $pref) {
                    $temp = $this->OMDBModel->getFromApi($pref['imdb_id'],2);
                    if($temp)
                    $data['movies'][] = $this->OMDBModel->asArray();
                }
            }
        } else{
            header('Location: '.site_url());
            exit;
        }

        $page = $this->load->view('user/preferences',$data,true);
        $this->load->view('skeleton',array('page'=>$page));
    }

    public function bookmarks_get(){
        $data = array();
        $data['title'] = 'Bookmarks';
        if(isset($_SESSION['userid'])) {
            $data['userid'] = $_SESSION['userid'];
            $this->UserModel->getById($_SESSION['userid']);
            $data['user'] = $this->UserModel;
            $data['movies'] = array();
            if(is_array($this->UserModel->getBookmarks())){
                foreach($this->UserModel->getBookmarks() as $pref) {
                    $temp = $this->OMDBModel->getFromApi($pref['imdb_id'],2);
                    if($temp)
                        $data['movies'][] = $this->OMDBModel->asArray();
                }
            }
        } else{
            header('Location: '.site_url());
            exit;
        }

        $page = $this->load->view('user/bookmarks',$data,true);
        $this->load->view('skeleton',array('page'=>$page));
    }

    public function bookmark_post($id){
        if(strlen($id) < 1){
            $this->response(array('error'=>'No movie provided.'),401);
            return;
        }

        if(isset($_SESSION['userid'])){
            $data['userid'] = $_SESSION['userid'];
            $this->UserModel->getById($_SESSION['userid']);
            $bookmark = $this->UserModel->bookmark($id);

            if($bookmark){
                $this->response(array('result'=>'OK'),200);
            } else{
                $this->response(array('error'=>'Something went wrong'),500);
            }

        } else{
            $this->response(array('error'=>'Please log in.'),401);
        }
    }

    public function dislike_post($id = ''){
        if(strlen($id) < 1){
            $this->response(array('error'=>'No movie provided.'),401);
            return;
        }

        if(isset($_SESSION['userid'])){
            $data['userid'] = $_SESSION['userid'];
            $this->UserModel->getById($_SESSION['userid']);
            $dislike = $this->UserModel->dislike($id);

            if($dislike){
                $this->response(array('result'=>'OK'),200);
            } else{
                $this->response(array('error'=>'Something went wrong'),500);
            }

        } else{
            $this->response(array('error'=>'Please log in.'),401);
        }
    }

    public function register_get(){
        $data = array();
        $page = $this->load->view('user/register',$data,true);
        $this->load->view('skeleton',array('page'=>$page));
    }

    public function register_post(){
        //todo
    }
}