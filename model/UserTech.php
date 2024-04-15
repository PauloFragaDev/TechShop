<?php

class UserTech
{
    private $idUser;
    private $email;
    private $password;
    private $fullname;
    private $filename;
    private $created;
    private $modified;
    private $token;
    private $verified;

    /**
     * @param $email
     * @param $password
     * @param $fullname
     * @param $filename
     */
    public function __construct($email, $password, $fullname,$filename)
    {
        $this->email = $email;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->filename = $filename;
        $this->created = new DateTime();
        $this->modified = new DateTime();
        $this->verified = false;
    }

    /**
     * @return mixed
     */

    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $pass
     */
    public function setPassword($pass)
    {
        $this->password = $pass;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated($created)
    {
        date_default_timezone_set("Europe/Madrid");
        $this->created = date('Y-m-d H:i:s',strtotime($created));
    }

    /**
     * @return DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param DateTime $modified
     */
    public function setModified($modified)
    {
        date_default_timezone_set("Europe/Madrid");
        $this->modified = date('Y-m-d H:i:s',strtotime($modified));
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return false
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param false $verified
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    }



}