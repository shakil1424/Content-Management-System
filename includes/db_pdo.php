<?php

$host ='localhost';
$user = 'root';
$password ='';
$database ='cms';

//set dsn
//$dsn = "mysql:host='localhost';dbname='cms';charset=UTF8";
$dsn = "mysql:host=$host;dbname=$database;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>