<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-07
 * Time: 10:28 AM
 */
class RecommendationController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('our');
        $this->load->library('session');
        $this->load->model('UserModel','',true);
        $this->load->model('OMDBModel');
        $this->load->model('TasteKidModel');
        $this->load->model('RecommendationCache','',true);
    }

    public function recommend($imdb_id,$pop=false){
        $data = array();
        if(isset($_SESSION['userid'])){
            $data['userid'] = $_SESSION['userid'];
            $this->UserModel->getById($_SESSION['userid']);
            $data['user'] = $this->UserModel;
        }
        if(empty($imdb_id)){
            $data['error'] = 'No IMDB ID provided.';

        }
        $cache = $this->RecommendationCache->readCache($imdb_id);
        if(is_array($cache)){
            $data['movie'] = $cache['movie'];
            //$data['recommendations'] = $cache['recommendations'];
            foreach($cache['recommendations'] as $v){
                if(isset($v['info']['imdbID']) && !$this->UserModel->disliked($v['info']['imdbID']))
                $data['recommendations'][] = $v;
            }
        } else{
            if($this->OMDBModel->getFromApi($imdb_id,2)){
                $data['movie'] = $this->OMDBModel->asArray();
                if(!$pop) {
                $this->TasteKidModel->getFromApi($data['movie']['Title']);
                $recNames = $this->TasteKidModel->getName();
                $rec = array();

                    foreach ($recNames as $k => $v) {
                        $info = array();
                        if ($this->OMDBModel->getFromApi($v)) {
                            $info = $this->OMDBModel->asArray();
                        }
                        //if(!$this->UserModel->disliked($info['imdbID'])){
                        $rec[] = array('name' => $v, 'info' => $info);
                    }

                    $data['recommendations'] = $rec;
                    $this->RecommendationCache->writeCache($imdb_id, $data['movie'], $data['recommendations']);
                }
            } else{
                $data['error'] = 'The movie ID provided seems to be invalid.';
            }
        }
        $data['title'] = $data['movie']['Title'];



        if($pop){
            $this->load->view('recommendation/popup',$data);
            return;
        }

        $page = $this->load->view('recommendation/recommendation_page',$data,true);
        $this->load->view('skeleton',array('page'=>$page));
    }
}