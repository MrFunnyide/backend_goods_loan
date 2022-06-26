<?php
$server = 'localhost';
$username = 'root';
$password = "";
$db = "goods_loan";

$response = [];

try{
$Conn = mysqli_connect($server,$username,$password,$db) ;

} catch(Exception $exception) {
$response['message'] = 'Error';
}