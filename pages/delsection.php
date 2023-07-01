<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
$section_id = $_GET['section-id'];
$stmt = $conn -> prepare("DELETE FROM sections WHERE section_id = ?");
$stmt -> execute([$section_id]);
header("location:sections.php");