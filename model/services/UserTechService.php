<?php
include_once "conex/Conex.php";
class UserTechService
{
    public static function addUser($user){
        $sql = "INSERT INTO users (email,password,fullname,filename,created_at,modified_at,verified) values(:email,:pass,:fn,:filen,:created,:modified,:verified)";
        $dades = array(
            'email' => $user->getEmail(),
            'pass' => $user->getPassword(),
            'fn' => $user->getFullName(),
            'filen' => $user->getFilename(),
            'created' => $user->getCreated()->format('Y-m-d H:i:s'),
            'modified' => $user->getModified()->format('Y-m-d H:i:s'),
            'verified' => $user->getVerified()?'1':'0'
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function deleteUser($idUser){
        $sql = "DELETE FROM users WHERE idUser= :id;";
        $dades = array(
            'id' => $idUser
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

    public static function updateUser($user){
        $sql = "UPDATE users SET email = :email, password = :password, fullname = :fn, filename = :filen, modified_at = :modified WHERE idUser = :idUser;";
        $dades = array(
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'fn' => $user->getFullName(),
            'filen' => $user->getFilename(),
            'modified' => $user->getModified()->format('Y-m-d H:i:s'),
            'idUser' => $user->getIdUser()
        );
        $con = new Conex();
        $con -> queryDataBase($sql,$dades);
    }

    public static function getAllUsers(){
        $sql = "SELECT * FROM users";
        $dades = array();
        $con = new Conex();
        $usersGet = $con->queryDataBase($sql,$dades)->fetchAll();
        $users = array ();
        foreach ($usersGet as $key => $userG){
            $user = new UserTech($userG[1],$userG[2],$userG[3],$userG[4]);
            $user->setIdUser($userG[0]);
            $user->setToken($userG[5]);
            $user->setCreated($userG[6]);
            $user->setModified($userG[7]);
            $user->setVerified($userG[8] == 1);
            $users[$key] = $user;
        }
        return $users;
    }

    public static function getUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email= :email";
        $dades = array(
            'email' => $email
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        if (empty($arrayAux)){
            return null;
        }
        $user = new UserTech($arrayAux[0][1],$arrayAux[0][2],$arrayAux[0][3],$arrayAux[0][4]);
        $user->setIdUser($arrayAux[0][0]);
        $user->setToken($arrayAux[0][5]);
        $user->setCreated($arrayAux[0][6]);
        $user->setModified($arrayAux[0][7]);
        return $user;
    }

    public static function getUserById($idUser){
        $sql = "SELECT * FROM users WHERE idUser = :idUser;";
        $dades = array(
            'idUser' => $idUser
        );
        $con = new Conex();
        $arrayAux = $con->queryDataBase($sql,$dades)->fetchAll();
        if (empty($arrayAux)){
            return null;
        }
        $user = new UserTech($arrayAux[0][1],$arrayAux[0][2],$arrayAux[0][3],$arrayAux[0][4]);
        $user->setIdUser($arrayAux[0][0]);
        $user->setToken($arrayAux[0][5]);
        $user->setCreated($arrayAux[0][6]);
        $user->setModified($arrayAux[0][7]);
        return $user;
    }

    public static function setTokenById($token,$idUser){
        $sql = "UPDATE users SET token = :token WHERE idUser = :idUser;";
        $dades = array(
            'token' => $token,
            'idUser' => $idUser
        );
        $con = new Conex();
        $con->queryDataBase($sql,$dades);
    }

}