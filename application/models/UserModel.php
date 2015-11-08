<?php

/**
 * Created by PhpStorm.
 * User: Krasio
 * Date: 7.11.2015 г.
 * Time: 10:36 ч.
 */
class UserModel extends CI_Model
{
    private $id = '';
    private $name = '';
    private $username = '';
    private $password = '';
    private $email = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function writeUser($name, $username, $password, $email)
    {
        $sql = 'INSERT INTO '.$this->db->dbprefix('users').' (name, username, password, email) VALUES (?,?,?,?)';
            $q = $this->db->query($sql, array($name, $username, sha1(sha1($username . '.' . $password)), $email));
    }

    public  function readUser($name)
    {
        $sql = 'SELECT * FROM '.$this->db->dbprefix('users').' WHERE name=?';
        $q = $this->db->query($sql,array($name));
    }

    public function passwordAuthenticate($username, $password)
    {
        $sql = 'SELECT * FROM '.$this->db->dbprefix('users').' WHERE username=? AND password=?';
        $q = $this->db->query($sql,array($username, sha1(sha1($username.'.'.$password))));
        if($q && $q->num_rows() == 1)
        {
            $row = $q->row();
            $this->id = $row->id;
            $this->name = $row->name;
            $this->username = $row->username;
            $this->email = $row->email;
            $this->session->set_userdata('userid',$row->id);
            return true;
        }else
            return false;
    }

    public function getById($id)
    {
        $sql = 'SELECT * FROM '.$this->db->dbprefix('users').' WHERE id=?';
        $q = $this->db->query($sql,array($id));
        if($q && $q->num_rows() == 1)
        {
            $row = $q->row();
            $this->id = $row->id;
            $this->name = $row->name;
            $this->username = $row->username;
            $this->email = $row->email;
            return true;
        }
    }

    public function dislike($id){
        $sql = 'SELECT * FROM '.$this->db->dbprefix('preferences').' WHERE imdb_id=? AND user = ?';
        $q = $this->db->query($sql,array($id,$this->UserModel->getId()));
        if($q){
            if($q->num_rows() < 1){
                $sql = 'INSERT INTO '.$this->db->dbprefix('preferences').' (user,imdb_id) VALUES (?,?)';
                $q = $this->db->query($sql,array($this->UserModel->getId(),$id));
                if($q) return true;
            } else{
                $sql = 'DELETE FROM '.$this->db->dbprefix('preferences').' WHERE user = ? AND imdb_id = ?';
                $q = $this->db->query($sql,array($this->UserModel->getId(),$id));
                if($q) return true;
            }
        }
        return false;
    }

    public function disliked($id){
        $sql = 'SELECT * FROM '.$this->db->dbprefix('preferences').' WHERE imdb_id=? AND user = ?';
        $q = $this->db->query($sql,array($id,$this->getId()));
        if($q && $q->num_rows() > 0){
            return true;
        }
        return false;
    }

    public function bookmark($id){
        $sql = 'SELECT * FROM '.$this->db->dbprefix('bookmarks').' WHERE imdb_id=? AND user = ?';
        $q = $this->db->query($sql,array($id,$this->UserModel->getId()));
        if($q){
            if($q->num_rows() < 1){
                $sql = 'INSERT INTO '.$this->db->dbprefix('bookmarks').' (user,imdb_id) VALUES (?,?)';
                $q = $this->db->query($sql,array($this->UserModel->getId(),$id));
                if($q) return true;
            } else{
                $sql = 'DELETE FROM '.$this->db->dbprefix('bookmarks').' WHERE user = ? AND imdb_id = ?';
                $q = $this->db->query($sql,array($this->UserModel->getId(),$id));
                if($q) return true;
            }
        }
        return false;
    }

    public function bookmarked($id){
        $sql = 'SELECT * FROM '.$this->db->dbprefix('bookmarks').' WHERE imdb_id=? AND user = ?';
        $q = $this->db->query($sql,array($id,$this->getId()));
        if($q && $q->num_rows() > 0){
            return true;
        }
        return false;
    }

    public function getPreferences(){
        $sql = 'SELECT imdb_id FROM '.$this->db->dbprefix('preferences').' WHERE user = ?';
        $q = $this->db->query($sql,$this->getId());
        if($q && $q->num_rows() > 0){
            $arr = array();
            foreach($q->result_array() as $row){
                $arr[] = $row;
            }
            return $arr;
        }
        return false;
    }

    public function getBookmarks(){
        $sql = 'SELECT imdb_id FROM '.$this->db->dbprefix('bookmarks').' WHERE user = ?';
        $q = $this->db->query($sql,$this->getId());
        if($q && $q->num_rows() > 0){
            $arr = array();
            foreach($q->result_array() as $row){
                $arr[] = $row;
            }
            return $arr;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}