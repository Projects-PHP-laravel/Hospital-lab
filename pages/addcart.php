<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$itemID = $_GET['q'];

$user_ID = $_SESSION['userid'];

$stmt = $conn -> prepare("INSERT INTO cart(user_userid, item_id)VALUES(?,?)");

$stmt -> execute([$user_ID, $itemID]);

$fetch_count_items = $conn -> query("SELECT COUNT(item_id)
FROM cart WHERE user_userid = $user_ID") -> fetchAll(PDO::FETCH_COLUMN);

echo $fetch_count_items[0];