<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 9:15 PM
 */
class TasteKidModel extends CI_Model
{

    private $Name = array();
    public function __construct()
    {
        parent::__construct();
    }

    public function getFromApi($name, $type = 'movies', $limit = 100, $key = '<insert-your-own>')
    {
        $data = file_get_contents('https://www.tastekid.com/api/similar?r=json&q='.urlencode($name).'&k='.$key.'&limit='.$limit.'&type='.$type);
        //Emergency - api is under ddos attack!
        //$data = file_get_contents(base_url('movie.txt'));
        $gets = json_decode($data, true);
        if (isset($gets['Similar']) && count($gets['Similar']['Results']) < 1) return false;
        foreach ($gets['Similar']['Results'] as $value) {
            $this->Name[] = $value['Name'];
        }
        return true;
    }

    /**
     * @return array
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param array $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }
}