<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 9:17 PM
 */
class YoutubeModel extends CI_Model
{
    private $videoId = array();
    public function __construct()
    {
        parent::__construct();
    }

    public function getVideoIdFromApi($query, $part = 'snippet', $key = '<insert-your-own>')
    {
        $data = file_get_contents('https://www.googleapis.com/youtube/v3/search?r=json&q=' .$query);
        $gets = json_decode($data, true);
        if (count($gets['items']['id']) < 1) return false;
        foreach ($gets['items']['id'] as $value) {
            $this->videoId[] = $value['videoId'];
        }
        return true;
    }

    /**
     * @return array
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * @param array $videoId
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    }
}