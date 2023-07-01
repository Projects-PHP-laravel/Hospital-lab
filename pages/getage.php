<?php
include "../master/sections/connect.php";
$patid = $_GET['q'];
$get_age = $conn -> query("SELECT pat_age FROM 
patients WHERE pat_id = $patid") -> fetchAll(PDO::FETCH_COLUMN);
echo $get_age[0];