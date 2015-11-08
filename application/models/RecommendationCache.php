<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-07
 * Time: 2:18 PM
 */
class RecommendationCache extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function writeCache($imdb_id, $movie_info, $recommendation_data,$exp_time = 604800){
        $sql = 'INSERT INTO '.$this->db->dbprefix('recommendation_cache').' (imdb_id,movie_info,recommendations,expires) VALUES (?,?,?,?)';
        $q = $this->db->query($sql,array($imdb_id,serialize($movie_info),serialize($recommendation_data),time()+$exp_time));
        if(!$q) return false;
        return true;
    }

    public function readCache($imdb_id){
        $sql = 'SELECT * FROM '.$this->db->dbprefix('recommendation_cache').' WHERE imdb_id=? AND expires >= ?';
        $q = $this->db->query($sql,array($imdb_id,time()));
        if($q && $q->num_rows() == 1){
            $row = $q->row();
            return array('movie'=>unserialize($row->movie_info),'recommendations'=>unserialize($row->recommendations));
        }
    }
}