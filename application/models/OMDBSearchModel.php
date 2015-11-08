<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 9:01 PM
 */
class OMDBSearchModel extends CI_Model
{

    private $imdbid = array();
    public function __construct()
    {
        parent::__construct();
    }
    public function getFromApi($string)
    {
        $data = file_get_contents('http://www.omdbapi.com/?r=json&type=movie&s=' . $string);
        $gets = json_decode($data, true);
        if (isset($gets['Error'])) return false;
        foreach ($gets['Search'] as $value){
            $this->imdbid[] = $value['imdbID'];
        }
        return true;
    }

    /**
     * @return array
     */
    public function getImdbid()
    {
        return $this->imdbid;
    }

    /**
     * @param array $imdbid
     */
    public function setImdbid($imdbid)
    {
        $this->imdbid = $imdbid;
    }

}