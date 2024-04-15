<?php
include_once "conex/Conex.php";
class RepairService
{
    public static function addRepair($repair){
        $sql = "INSERT INTO repairs (idUser,idProduct,idPedido,status,created,modified) values (:idUser, :idProduct, :idPedido, :status, :created, :modified);";
        $dades = array(
            'idUser' => $repair->getIdUser(),
            'idProduct' => $repair->getIdProduct(),
            'idPedido' => $repair->getIdPedido(),
            'status' => $repair->getStatus(),
            'created' => $repair->getCreated()->format('Y-m-d H:i:s'),
            'modified' => $repair->getModified()->format('Y-m-d H:i:s'),
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function updateRepair($repair){
        $sql = "UPDATE repairs SET status = :status, modified = :modified WHERE idRepair = :idRepair;";
        $dades = array(
            'status' => $repair->getStatus(),
            'modified' => $repair->getModified()->format('Y-m-d H:i:s'),
            'idRepair' => $repair->getIdRepair()
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function getAllRepairs(){
        $sql = "SELECT * FROM repairs";
        $dades = array();
        $con = new Conex();
        $arrayRepair = $con->queryDataBase($sql,$dades)->fetchAll();
        $arrayG = array();
        if (!empty($arrayRepair)){
            foreach ($arrayRepair as $key => $repair){
                $r = new Repair($repair[1],$repair[2],$repair[3],$repair[4]);
                $r->setIdRepair($repair[0]);
                $r->setCreated($repair[5]);
                $r->setModified($repair[6]);
                $arrayG[$key] = $r;
            }
            return $arrayG;
        }
        return array();
    }

    public static function getRepairById($idRepair){
        $sql = "SELECT * FROM repairs WHERE idRepair = :idRepair;";
        $dades = array(
            'idRepair' => $idRepair
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
        $aRepair = $con->queryDataBase($sql,$dades)->fetchAll();
        if (empty($aRepair)){
            return null;
        }
        $repair = new Repair($aRepair[0][1],$aRepair[0][2],$aRepair[0][3],$aRepair[0][4]);
        $repair->setIdRepair($aRepair[0][0]);
        $repair->setCreated($aRepair[0][5]);
        $repair->setModified($aRepair[0][6]);
        return $repair;
    }

    public static function getRepairUser($idUser){
        $sql = "SELECT * FROM repairs WHERE idUser = :idUser;";
        $dades = array(
            'idUser' => $idUser
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        $arrayG = array();
        if (empty($arrayAux)){
            return array();
        }
        foreach ($arrayAux as $key => $repair){
            $r = new Repair($repair[1],$repair[2],$repair[3],$repair[4]);
            $r->setIdRepair($repair[0]);
            $arrayG[$key] = $r;
        }
        return $arrayG;
    }

}