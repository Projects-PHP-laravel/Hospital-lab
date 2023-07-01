<?php
session_start();
include "../master/sections/connect.php";
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $pat_id = $_POST['pat'];
    $invoice_id = $_POST['inv-id'];
    $invoice_date = $_POST['inv-date'];
    $invoice_time = $_POST['inv-time'];
    $invoice_total = $_POST['total'];
    $emp_id = $_POST['emp'];
    $user_ID = $_SESSION['userid'];
    $exam = $_POST['exam'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];

    function exam_filter($value){
        return $value != "start";
    }

    $new_exam = array_filter($exam, "exam_filter");

    
    // insert into invoice table 
    $stmt1 = $conn -> prepare("INSERT INTO invoices(invoice_id, pat_id, invoice_date, invoice_time, 
    invoice_total, emp_id, user_userid)VALUES(?,?,?,?,?,?,?)");
    $stmt1 ->execute([$invoice_id, $pat_id, $invoice_date, $invoice_time, $invoice_total, $emp_id, $user_ID]);

    // insert into invoice detil table 
    for( $i = 0; $i < count($new_exam); $i++){
        $sql = $conn -> prepare("INSERT INTO invoice_details(invoice_id, exam_id, price, discount)
        VALUES(?,?,?,?)");
        $sql -> execute([$invoice_id, $new_exam[$i], $price[$i], $discount[$i]]);
    }

    header("location:invoice.php");
}