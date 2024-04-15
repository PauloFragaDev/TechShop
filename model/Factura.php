<?php

class Factura
{
    private $idFactura;
    private $idCarrito;
    private $idPedido;
    private $totalPrice;
    private $dateOrder;

    /**
     * @param $idCarrito
     * @param $idPedido
     * @param $totalPrice
     */
    public function __construct($idCarrito, $idPedido, $totalPrice)
    {
        $this->idCarrito = $idCarrito;
        $this->idPedido = $idPedido;
        $this->totalPrice = $totalPrice;
        $this->dateOrder = new DateTime();
    }


    /**
     * @return mixed
     */
    public function getIdFactura()
    {
        return $this->idFactura;
    }

    /**
     * @param mixed $idFactura
     */
    public function setIdFactura($idFactura)
    {
        $this->idFactura = $idFactura;
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
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getDateOrder()
    {
        return $this->dateOrder;
    }

    /**
     * @param mixed $dateOrder
     */
    public function setDateOrder($dateOrder)
    {
        $this->dateOrder = $dateOrder;
    }


}