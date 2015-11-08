<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 11:54 PM
 */
class SearchController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('our');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('UserModel','',true);
        $this->load->model('OMDBSearchModel');
        $this->load->model('OMDBModel');
        $this->load->model('SearchCache','',true);
    }

    public function search($criteria){
        $criteria = urldecode($criteria);
        $data = array();
        if(isset($_SESSION['userid'])){
            $data['userid'] = $_SESSION['userid'];
            $this->UserModel->getById($_SESSION['userid']);
            $data['user'] = $this->UserModel;
        }
        $data['criteria'] = $criteria;
        $cacheData = $this->SearchCache->readCache($criteria);
        if(is_array($cacheData)){
            $data['movies'] = $cacheData['omdb_data'];
        } else{
            $this->OMDBSearchModel->getFromApi(urlencode($criteria));
            $res = $this->OMDBSearchModel->getImdbid();
            $data['movies'] = array();
            foreach($res as $r){
                if($this->OMDBModel->getFromApi($r,2)){
                    $data['movies'][] = $this->OMDBModel->asArray();
                }
            }
            $this->SearchCache->writeCache($criteria,$data['movies'],$res);
        }



        $page = $this->load->view('search/searchpage.php',$data,true);
        $this->load->view('skeleton',array('page'=>$page,'title'=>'Search - '.$criteria));


    }


}