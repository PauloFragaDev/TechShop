<?php
include_once "conex/Conex.php";
class FacturaService
{
    public static function addFactura($factura){
        $sql = "INSERT INTO facturas (idCarrito,idPedido,totalPrice,orderDate) values (:idCarrito,:idPedido,:totalPrice,:orderDate);";
        $dades = array(
            'idCarrito' => $factura->getIdCarrito(),
            'idPedido' => $factura->getIdPedido(),
            'totalPrice' => $factura->getTotalPrice(),
            'orderDate' => $factura->getDateOrder()->format('Y-m-d H:i:s')
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function getFacturas(){
        $sql = "SELECT products.filename, users.fullname, products.name, products.price, facturas.totalPrice, facturas.orderDate FROM facturas 
                JOIN carritos ON facturas.idCarrito=carritos.idCarrito 
                JOIN users ON carritos.idUser=users.idUser 
                JOIN carritoItems ON facturas.idPedido=carritoItems.idOrder
                JOIN products ON carritoItems.idProduct=products.idProduct;";
        $dades = array();
        $con = new Conex();
        return $con->queryDataBase($sql,$dades)->fetchAll();
    }

    public static function getProductFacturaByUserId($idUser){
        $sql = "SELECT products.idProduct, products.filename, products.name, products.price, facturas.orderDate, facturas.idPedido FROM facturas
                JOIN orders ON facturas.idPedido=orders.idOrder
                JOIN carritoItems ON facturas.idPedido=carritoItems.idOrder
                JOIN products ON carritoItems.idProduct=products.idProduct
                WHERE orders.idUser = :idUser";
        $dades = array(
            'idUser' => $idUser
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        if (empty($arrayAux)){
            return array();
        }
        return $arrayAux;
    }
    public static function getPedido($idProduct, $idFactura){
        $sql = "SELECT carritoItems.idOrder FROM facturas
                JOIN carritoItems ON facturas.idPedido=carritoItems.idOrder
                WHERE idFactura = :idFactura
                AND carritoItems.idOrder = facturas.idPedido
                AND carritoItems.idProduct = :idProduct;";
        $dades = array(
            'idFactura' => $idFactura,
            'idProduct' => $idProduct
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        echo "<pre>";
        var_dump($arrayAux);
        echo "</pre>";
        die();
        if (empty($arrayAux)){
            return array();
        }
        return $arrayAux;
    }

}