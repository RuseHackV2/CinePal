<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-07
 * Time: 8:40 AM
 */
class SearchCache extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function writeCache($query_string, $omdb_data,$search_results,$exp_time = 172800){
        $sql = 'SELECT * FROM '.$this->db->dbprefix('search_cache').' WHERE query_string=? AND expires >= ?';
        $q = $this->db->query($sql,array($query_string,$exp_time));
        if($q->num_rows() < 1){
            $sql = 'INSERT INTO '.$this->db->dbprefix('search_cache').' (query_string,omdb_data,search_results,expires) VALUES (?,?,?,?)';
            $q = $this->db->query($sql,array($query_string,serialize($omdb_data),serialize($search_results),time()+$exp_time));
            if(!$q) return false;
        }
        return true;
    }

    public function readCache($query_string){
        $sql = 'SELECT * FROM '.$this->db->dbprefix('search_cache').' WHERE query_string=? AND expires >= ?';
        $q = $this->db->query($sql,array($query_string,time()));
        if($q && $q->num_rows() == 1){
            $row = $q->row();
            $sql = 'UPDATE '.$this->db->dbprefix('search_cache').' SET hits = hits+1 WHERE query_string = ? AND expires >= ?';
            $q = $this->db->query($sql,array($query_string,time()));
            if ($q)
                return array('query_string'=>$query_string,
                                'search_results'=>unserialize($row->search_results),
                                'omdb_data'=>unserialize($row->omdb_data),
                                'hits'=>$row->hits,
                                'expires'=>$row->expires);
        }
        return false;
    }

    public function last($num=10){
        $sql = 'SELECT query_string FROM '.$this->db->dbprefix('search_cache').' ORDER BY expires DESC LIMIT 0,?';
        $q = $this->db->query($sql,array(intval($num)));
        if(!$q || $q->num_rows() < 1) return false;
        $ret = array();
        foreach($q->result() as $row){
            $ret[] = $row;
        }
        return $ret;

    }

    public function popular($num=10){
        $sql = 'SELECT query_string, SUM(hits) FROM '.$this->db->dbprefix('search_cache').' GROUP BY query_string ORDER BY SUM(hits) DESC LIMIT 0,?';
        $q = $this->db->query($sql,array(intval($num)));
        if(!$q || $q->num_rows() < 1) return false;
        $ret = array();
        foreach($q->result() as $row){
            $ret[] = $row;
        }
        return $ret;

    }

}