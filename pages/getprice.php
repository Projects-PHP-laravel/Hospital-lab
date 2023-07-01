<?php
include "../master/sections/connect.php";
$examid = $_GET['q'];
$get_price = $conn -> query("SELECT exam_price FROM 
examinations WHERE exam_id = $examid") -> fetchAll(PDO::FETCH_COLUMN);
echo $get_price[0];