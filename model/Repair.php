<?php

class Repair
{
    private $idRepair;
    private $idUser;
    private $idProduct;
    private $idPedido;
    private $status;//HAY 3 STATUS -> 1 = REPARACION ; 2 = ENVIADO ; 3 = ENTREGADO
    private $created;
    private $modified;

    /**
     * @param $idUser
     * @param $idProduct
     * @param $status
     */
    public function __construct($idUser, $idProduct, $idPedido, $status)
    {
        $this->idUser = $idUser;
        $this->idProduct = $idProduct;
        $this->idPedido = $idPedido;
        $this->status = $status;
        $this->created = new DateTime();
        $this->modified = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getIdRepair()
    {
        return $this->idRepair;
    }

    /**
     * @param mixed $idRepair
     */
    public function setIdRepair($idRepair)
    {
        $this->idRepair = $idRepair;
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
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * @param mixed $idProduct
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;
    }

    /**
     * @return mixed
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * @param mixed $idPedido
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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



}