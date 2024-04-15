<?php

class CarritoItem
{
    private $idCarritoItem;
    private $idCarrito;
    private $idProducto;
    private $idOrder;

    /**
     * @param $idCarrito
     * @param $idProducto
     * @param $idOrder
     */
    public function __construct($idCarrito, $idProducto, $idOrder)
    {
        $this->idCarrito = $idCarrito;
        $this->idProducto = $idProducto;
        $this->idOrder = $idOrder;
    }

    /**
     * @return mixed
     */
    public function getIdCarritoItem()
    {
        return $this->idCarritoItem;
    }

    /**
     * @param mixed $idCarritoItem
     */
    public function setIdCarritoItem($idCarritoItem)
    {
        $this->idCarritoItem = $idCarritoItem;
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
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * @param mixed $idProducto
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    /**
     * @return mixed
     */
    public function getIdOrder()
    {
        return $this->idOrder;
    }

    /**
     * @param mixed $idOrder
     */
    public function setIdOrder($idOrder)
    {
        $this->idOrder = $idOrder;
    }



}