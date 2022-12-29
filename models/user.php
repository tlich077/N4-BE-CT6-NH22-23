<?php

class User extends Db{
    public function getUserByUsername($username)
    {
        $sql = self::$connection->prepare("SELECT username FROM users WHERE username = ?");
        $sql->bind_param("s",$username);
        $sql->execute(); 
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getInsertUser($fullname,$username,$password)
    {
        $sql = self::$connection->prepare("INSERT INTO users(id, fullname, username, password)
        VALUES (NULL, '$fullname', '$username', '$password')");
        $sql->execute(); 
    }
    public function getLogin($username,$password)
    {
        $sql = self::$connection->prepare("SELECT * FROM users WHERE username = '$username' OR password = '".md5($password)."'");
        $sql->execute(); 
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getUserById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM users WHERE id = ?");
        $sql->bind_param("i",$id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
}
