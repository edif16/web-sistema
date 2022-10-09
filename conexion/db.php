<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'sistema';


try{
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);

}catch(PDOException $e ){

    die('Connected faild: '.$e->getMessage());
}

?>