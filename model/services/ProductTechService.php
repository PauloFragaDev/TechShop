<?php

include_once "conex/Conex.php";

class ProductTechService
{
    public static function addProduct($product)
    {
        $sql = "INSERT INTO products (brand,name,price,filename) values(:brand,:name,:price,:filename)";
        $dades = array(
            'brand' => $product->getBrand(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'filename' => $product->getFilename()
        );
        $con = new Conex();
        $con->queryDataBase($sql, $dades);
    }

    public static function updateProduct($product){
        $sql = "UPDATE products SET brand = :brand, name = :name, price = :price, filename = :filename WHERE idProduct = :idProduct;";
        $dades = array(
            'brand' => $product->getBrand(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'filename' => $product->getFilename(),
            'idProduct' => $product->getIdProduct()
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function deleteProduct($idProduct)
    {
        $sql = "DELETE FROM products WHERE idProduct= :id";
        $dades = array(
            'id' => $idProduct
        );
        $con = new Conex();
        $con->queryDataBase($sql, $dades);
    }

    public static function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        $dades = array();
        $con = new Conex();
        $productsGet = $con->queryDataBase($sql, $dades)->fetchAll();
        $products = array();
        foreach ($productsGet as $key => $productG) {
            $product = new ProductTech($productG[1], $productG[2], $productG[3], $productG[4]);
            $product->setIdProduct($productG[0]);
            $products[$key] = $product;
        }
        return $products;
    }

    public static function getProductById($idProduct)
    {
        $sql = "SELECT * FROM products WHERE idProduct = :idProduct;";
        $dades = array(
            'idProduct' => $idProduct
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql, $dades)->fetchAll();
        $product = new ProductTech($arrayAux[0][1], $arrayAux[0][2], $arrayAux[0][3], $arrayAux[0][4]);
        $product->setIdProduct($arrayAux[0][0]);
        return $product;
    }

    public static function checkFile($filename){
        $sql = "SELECT * FROM products WHERE filename = :filename;";
        $dades = array(
            'filename' => $filename
        );
        $con = new Conex();
        return $con->queryDataBase($sql,$dades)->fetchAll();
    }

}