<?php
include_once "conex/Conex.php";
include_once "../../conf.php";

class InitService
{
    public static function createTables()
    {
        $sql = "CREATE TABLE `daw_db`.`users` (`idUser` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `fullname` VARCHAR(100) NOT NULL,`filename` VARCHAR(100) NOT NULL , `token` VARCHAR(100) NULL , `created_at` DATETIME(6) NOT NULL , `modified_at` DATETIME(6) NOT NULL , `verified` BOOLEAN NOT NULL , PRIMARY KEY (`idUser`), UNIQUE (`email`)) ENGINE = InnoDB;
                CREATE TABLE `daw_db`.`products` (`idProduct` INT NOT NULL AUTO_INCREMENT , `brand` VARCHAR(100) NOT NULL , `name` VARCHAR(100) NOT NULL , `price` FLOAT NOT NULL , `filename` VARCHAR(100) NOT NULL , PRIMARY KEY (`idProduct`)) ENGINE = InnoDB;
                CREATE TABLE `daw_db`.`facturas` (`idFactura` INT NOT NULL AUTO_INCREMENT , `idCarrito` INT NOT NULL , `idPedido` INT NOT NULL , `totalPrice` FLOAT NOT NULL , `orderDate` DATETIME(6) NOT NULL , PRIMARY KEY (`idFactura`)) ENGINE = InnoDB;
                CREATE TABLE `daw_db`.`repairs` (`idRepair` INT NOT NULL AUTO_INCREMENT , `idUser` INT NOT NULL , `idProduct` INT NOT NULL , `idPedido` INT NOT NULL, `status` VARCHAR(100) NOT NULL , `created` DATETIME(6) NOT NULL , `modified` DATETIME(6) NOT NULL , PRIMARY KEY (`idRepair`)) ENGINE = InnoDB;
                CREATE TABLE `daw_db`.`carritos` (`idCarrito` INT NOT NULL AUTO_INCREMENT , `idUser` INT NOT NULL , PRIMARY KEY (`idCarrito`)) ENGINE = InnoDB;
                CREATE TABLE `daw_db`.`carritoItems` (`idCarritoItem` INT NOT NULL AUTO_INCREMENT , `idCarrito` INT NOT NULL , `idProduct` INT NOT NULL , `idOrder` INT NOT NULL , PRIMARY KEY (`idCarritoItem`)) ENGINE = InnoDB;
                CREATE TABLE `daw_db`.`orders` (`idOrder` INT NOT NULL AUTO_INCREMENT , `idUser` INT NOT NULL , PRIMARY KEY (`idOrder`)) ENGINE = InnoDB;";
        $con = new Conex();
        $con->queryDataBase($sql,array());
    }

    public static function foreignKeysTables(){
        $sql = "ALTER TABLE `carritoItems` ADD CONSTRAINT `eliminarCarrito` FOREIGN KEY (`idCarrito`) REFERENCES `carritos`(`idCarrito`) ON DELETE CASCADE ON UPDATE CASCADE; 
                ALTER TABLE `carritoItems` ADD CONSTRAINT `eliminarOrder` FOREIGN KEY (`idOrder`) REFERENCES `orders`(`idOrder`) ON DELETE CASCADE ON UPDATE CASCADE; 
                ALTER TABLE `carritoItems` ADD CONSTRAINT `eliminarProduct` FOREIGN KEY (`idProduct`) REFERENCES `products`(`idProduct`) ON DELETE RESTRICT ON UPDATE RESTRICT;
                ALTER TABLE `orders` ADD CONSTRAINT `enlaceOrders` FOREIGN KEY (`idUser`) REFERENCES `users`(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE `carritos` ADD CONSTRAINT `enlaceCarritos` FOREIGN KEY (`idUser`) REFERENCES `users`(`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;";
        $con = new Conex();
        $con->queryDataBase($sql,array());
    }

    public static function dropTables(){
        $sql = "DROP TABLE if EXISTS users,products,orders,repairs,facturas,carritos,carritoItems";
        $con = new Conex();
        $con->queryDataBase($sql,array());
    }

    public static function createUsers(){
        $pepper = getPepper();
        $p_peppered = hash_hmac('sha256', '1234',$pepper);
        $p_peppered2 = hash_hmac('sha256', '1234',$pepper);
        $p = password_hash($p_peppered,PASSWORD_BCRYPT);
        $p2 = password_hash($p_peppered2,PASSWORD_BCRYPT);
        $sql = "INSERT INTO `users` (`idUser`, `email`, `password`, `fullname`, `filename`, `token`, `created_at`, `modified_at`, `verified`) VALUES ('1', 'admin@admin.com', '$p', 'admin', 'default', 'ahwodhqhd91h9dgh29gdg1gg19', '2022-10-24 19:21:13.000000', '2022-10-24 19:21:13.000000', '1');
                INSERT INTO `users` (`idUser`, `email`, `password`, `fullname`, `filename`, `token`, `created_at`, `modified_at`, `verified`) VALUES ('2', 'paulo@paulo.com', '$p2', 'paulo', 'peppo', 'hawodhqwui92g8e37828ud81ffv36727', '2022-10-28 16:00:00.000000', '2022-10-28 16:00:00.000000', '1');";
        $con = new Conex();
        $con->queryDataBase($sql,array());
    }

    public static function createProducts(){
        $sql = "INSERT INTO `products` (`idProduct`, `brand`, `name`, `price`, `filename`) VALUES ('1', 'Lenovo', 'Ideapad 3', '599.99', 'lenovo');
                INSERT INTO `products` (`idProduct`, `brand`, `name`, `price`, `filename`) VALUES ('2', 'Apple', 'Iphone 22 LOW COST', '1399.49', 'iphonelila');
                INSERT INTO `products` (`idProduct`, `brand`, `name`, `price`, `filename`) VALUES ('3', 'MSI', 'Monitor XPGA 27ª', '239.79', 'monitormsi');
                INSERT INTO `products` (`idProduct`, `brand`, `name`, `price`, `filename`) VALUES ('4', 'NZXT', 'NZXTMB - White', '469.99', 'nzxtblancomate');
                INSERT INTO `products` (`idProduct`, `brand`, `name`, `price`, `filename`) VALUES ('5', 'PCCOM', 'PC Silver Cost', '699.99', 'sobremesablack');
                INSERT INTO `products` (`idProduct`, `brand`, `name`, `price`, `filename`) VALUES ('6', 'Razer', 'Razer Cynatra', '79.89', 'tecladorazer');";
        $con = new Conex();
        $con->queryDataBase($sql,array());
    }

    public static function createPaySystem(){
        $sql = "INSERT INTO `carritos` (`idCarrito`, `idUser`) VALUES ('1', '2');
                INSERT INTO `orders` (`idOrder`, `idUser`) VALUES ('1','2');";
        $con = new Conex();
        $con->queryDataBase($sql,array());
    }

}