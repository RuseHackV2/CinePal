<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 8:44 PM
 */

define('MODE_TITLE',1);
define('MODE_ID',2);

class OMDBModel extends CI_Model
{

    private $Title = '';
    private $Year = '';
    private $Rated = '';
    private $Released = '';
    private $Runtime = '';
    private $Genre = '';
    private $Director = '';
    private $Writer = '';
    private $Actors = '';
    private $Plot = ''; //plot description
    private $Language = '';
    private $Country = '';
    private $Awards = '';
    private $Poster = ''; //poster image url
    private $Metascore = '';
    private $imdbRating = '';
    private $imdbVotes = '';
    private $imdbID = '';
    private $Type = '';
    private $Response = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function getFromApi($string, $mode = MODE_TITLE){ //$string is title or id
        $string = urlencode($string);
        switch($mode) {
            case MODE_TITLE:
                $data = file_get_contents('http://www.omdbapi.com/?r=json&t=' . $string);
                $gets = json_decode($data, true);
                if (isset($gets['Error'])) return false;
                foreach ($gets as $key => $value) {
                    $this->$key = $value;
                }
                if($this->Poster == 'N/A'){
                    $this->Poster = base_url('static/images/no_poster.png');
                }
                break;

            case MODE_ID:
                $data = file_get_contents('http://www.omdbapi.com/?r=json&i=' . $string);
                $gets = json_decode($data, true);
                if (isset($gets['Error'])) return false;
                foreach ($gets as $key => $value) {
                    $this->$key = $value;
                }
                if($this->Poster == 'N/A'){
                    $this->Poster = base_url('static/images/no_poster.png');
                }
                break;
        }
        return true;
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->Year;
    }

    /**
     * @param string $Year
     */
    public function setYear($Year)
    {
        $this->Year = $Year;
    }

    /**
     * @return string
     */
    public function getRated()
    {
        return $this->Rated;
    }

    /**
     * @param string $Rated
     */
    public function setRated($Rated)
    {
        $this->Rated = $Rated;
    }

    /**
     * @return string
     */
    public function getReleased()
    {
        return $this->Released;
    }

    /**
     * @param string $Released
     */
    public function setReleased($Released)
    {
        $this->Released = $Released;
    }

    /**
     * @return string
     */
    public function getRuntime()
    {
        return $this->Runtime;
    }

    /**
     * @param string $Runtime
     */
    public function setRuntime($Runtime)
    {
        $this->Runtime = $Runtime;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->Genre;
    }

    /**
     * @param string $Genre
     */
    public function setGenre($Genre)
    {
        $this->Genre = $Genre;
    }

    /**
     * @return string
     */
    public function getDirector()
    {
        return $this->Director;
    }

    /**
     * @param string $Director
     */
    public function setDirector($Director)
    {
        $this->Director = $Director;
    }

    /**
     * @return string
     */
    public function getWriter()
    {
        return $this->Writer;
    }

    /**
     * @param string $Writer
     */
    public function setWriter($Writer)
    {
        $this->Writer = $Writer;
    }

    /**
     * @return string
     */
    public function getActors()
    {
        return $this->Actors;
    }

    /**
     * @param string $Actors
     */
    public function setActors($Actors)
    {
        $this->Actors = $Actors;
    }

    /**
     * @return string
     */
    public function getPlot()
    {
        return $this->Plot;
    }

    /**
     * @param string $Plot
     */
    public function setPlot($Plot)
    {
        $this->Plot = $Plot;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->Language;
    }

    /**
     * @param string $Language
     */
    public function setLanguage($Language)
    {
        $this->Language = $Language;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @param string $Country
     */
    public function setCountry($Country)
    {
        $this->Country = $Country;
    }

    /**
     * @return string
     */
    public function getAwards()
    {
        return $this->Awards;
    }

    /**
     * @param string $Awards
     */
    public function setAwards($Awards)
    {
        $this->Awards = $Awards;
    }

    /**
     * @return string
     */
    public function getPoster()
    {
        return $this->Poster;
    }

    /**
     * @param string $Poster
     */
    public function setPoster($Poster)
    {
        $this->Poster = $Poster;
    }

    /**
     * @return string
     */
    public function getMetascore()
    {
        return $this->Metascore;
    }

    /**
     * @param string $Metascore
     */
    public function setMetascore($Metascore)
    {
        $this->Metascore = $Metascore;
    }

    /**
     * @return string
     */
    public function getImdbRating()
    {
        return $this->imdbRating;
    }

    /**
     * @param string $imdbRating
     */
    public function setImdbRating($imdbRating)
    {
        $this->imdbRating = $imdbRating;
    }

    /**
     * @return string
     */
    public function getImdbVotes()
    {
        return $this->imdbVotes;
    }

    /**
     * @param string $imdbVotes
     */
    public function setImdbVotes($imdbVotes)
    {
        $this->imdbVotes = $imdbVotes;
    }

    /**
     * @return string
     */
    public function getImdbID()
    {
        return $this->imdbID;
    }

    /**
     * @param string $imdbID
     */
    public function setImdbID($imdbID)
    {
        $this->imdbID = $imdbID;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->Response;
    }

    /**
     * @param string $Response
     */
    public function setResponse($Response)
    {
        $this->Response = $Response;
    }

    public function asArray(){
        $arr2 = array();
        foreach((array)$this as $k=>$v){
            $arr2[substr($k,11,strlen($k))] = $v;
        }

        return $arr2;
    }
}