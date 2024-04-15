<?php

class CarritoService
{
    public static function addCarrito($idUser){
        $sql = "INSERT INTO carritos (idUser) values (:idUser)";
        $dades = array(
            'idUser' =>   $idUser
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function getCarritoUser($idUser){
        $sql = "SELECT * FROM carritos WHERE idUser = :idUser;";
        $dades = array(
            'idUser' => $idUser
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        $carrito = new Carrito($arrayAux[0][1]);
        $carrito->setIdCarrito($arrayAux[0][0]);
        return $carrito;
    }
}