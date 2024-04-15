<?php
include_once "conex/Conex.php";
class OrderService
{
    public static function addOrder($idUser){
        $sql = "INSERT INTO orders (idUser) values (:idUser)";
        $dades = array(
          'idUser' =>   $idUser
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function getOrderUser($idUser){
        $sql = "SELECT * FROM orders WHERE idUser = (SELECT MAX(idUser) FROM orders WHERE idUser = :idUser ORDER BY idUser) ORDER BY idOrder DESC LIMIT 1";
        $dades = array(
            'idUser' => $idUser
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        if (empty($arrayAux)){
            return null;
        }
        $order = new Order($arrayAux[0][1]);
        $order->setIdOrder($arrayAux[0][0]);
        return $order;
    }
}