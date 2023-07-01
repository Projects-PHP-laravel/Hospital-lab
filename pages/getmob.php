<?php
include "../master/sections/connect.php";
$patid = $_GET['q'];
$get_phone = $conn -> query("SELECT pat_phone FROM 
patients WHERE pat_id = $patid") -> fetchAll(PDO::FETCH_COLUMN);
echo $get_phone[0];