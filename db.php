<?php
$conn = new mysqli("localhost","root","2277","my_invoice_software");
if($conn->connect_error){
    die("Database connection failed");
}
session_start();
if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];
?>
