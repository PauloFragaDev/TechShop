<?php
include_once "conex/Conex.php";
class CarritoItemService
{
    public static function createItem($item){
        $sql = "INSERT INTO carritoItems (idCarrito,idProduct,idOrder) values (:idCarrito,:idProduct,:idOrder);";
        $dades = array(
            'idCarrito' => $item->getIdCarrito(),
            'idProduct' => $item->getIdProducto(),
            'idOrder' => $item->getIdOrder()
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function getByUser($idOrder,$idCarrito){
        $sql = "SELECT * FROM carritoItems WHERE idCarrito = :idCarrito AND idOrder = :idOrder;";
        $dades = array(
            'idCarrito' => $idCarrito,
            'idOrder' => $idOrder
        );
        $con = new Conex();
        $itemsGet = $con->queryDataBase($sql,$dades)->fetchAll();
        $items = array();
        foreach ($itemsGet as $key => $itemG){
            $item = new CarritoItem($itemG[1],$itemG[2],$itemG[3]);
            $item->setIdCarritoItem($itemG[0]);
            $items[$key] = $item;
        }
        return $items;
    }

    public static function deleteItem($idProduct, $idCarrito, $idOrder){
        $sql = "DELETE FROM carritoItems WHERE idProduct = :idProduct AND idCarrito = :idCarrito AND idOrder = :idOrder;";
        $dades = array(
          'idProduct' => $idProduct,
            'idCarrito' => $idCarrito,
            'idOrder' => $idOrder
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function checkProduct($idProduct, $idCarrito, $idOrder){
        $sql = "SELECT * FROM carritoItems WHERE idProduct = :idProduct AND idCarrito = :idCarrito AND idOrder = :idOrder;";
        $dades = array(
            'idProduct' => $idProduct,
            'idCarrito' => $idCarrito,
            'idOrder' => $idOrder
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        if (empty($arrayAux)){
            return null;
        }
        $item = new CarritoItem($arrayAux[0][1],$arrayAux[0][2],$arrayAux[0][3]);
        $item->setIdCarritoItem($arrayAux[0][0]);
        return $item;
    }

}