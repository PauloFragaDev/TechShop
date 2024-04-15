<?php

class Carrito
{
    private $idCarrito;
    private $idUser;

    /**
     * @param $idUser
     */
    public function __construct($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    /**
     * @param mixed $idCarrito
     */
    public function setIdCarrito($idCarrito)
    {
        $this->idCarrito = $idCarrito;
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


}