<?php

class Conex
{
    private $host;
    private $db;
    private $dsn;
    private $user;
    private $pass;
    public $conexio;

    public function __construct()
    {
        $this->host = 'mysql';
        $this->db = "daw_db";
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db . ';';
        $this->user = 'hector';
        $this->pass = "123456";
    }

    public function openConnection()
    {
        try {
            $this->conexio = new PDO($this->dsn, $this->user, $this->pass);
            return $this->conexio;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
            return null;
        }
    }

//CREATE TABLE `daw_db`.`products` ( `id_product` INT(5) NOT NULL AUTO_INCREMENT , `ref_product` VARCHAR(20) NOT NULL , `desc_product` VARCHAR(200) NOT NULL , `price_product` FLOAT(5) NOT NULL , `img_product` VARCHAR(100) NOT NULL , PRIMARY KEY (`id_product`)) ENGINE = InnoDB;
//CREATE TABLE `daw_db`.`users` (`id_user` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `pass` VARCHAR(100) NOT NULL , PRIMARY KEY (`id_user`)) ENGINE = InnoDB;
    public function closeConnection()
    {
        try {
            $this->conexio = null;
            return $this->conexio;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
            return null;
        }
    }

    public function queryDataBase($sql, $params)
    {

        $this->openConnection();
        try {
            $this->statement = $this->conexio->prepare($sql);
            $this->statement->execute($params);
            $result = $this->statement;
            $this->closeConnection();
            return $result;
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            echo $ex->getMessage();
            $this->closeConnection();
            return null;
        }

    }







}