<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$treatID = $_GET['treat-id'];

$stmt = $conn -> prepare("UPDATE treat_doctors SET column_active = 0
WHERE treat_id = $treatID");

$stmt -> execute();

header("location:treat.php");