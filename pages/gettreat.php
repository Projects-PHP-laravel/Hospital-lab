<?php
include "../master/sections/connect.php";
$patid = $_GET['q'];
$get_treat = $conn -> query("SELECT pat_id, treat_name FROM 
patients INNER JOIN treat_doctors USING(treat_id) WHERE pat_id = $patid") -> fetchAll(PDO::FETCH_KEY_PAIR);
echo $get_treat[$patid];