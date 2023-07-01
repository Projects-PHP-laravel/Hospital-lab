<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] == "user"){
        header("location:out.php");
    }
    include "../master/sections/connect.php";
    include "../master/sections/start.php";
    include "../master/sections/alinks.php";
    include "../master/sections/mid1.php";
?>
<?php echo $_SESSION['user'] ;?> <i class="fas fa-chevron-down" id="icon-arrow"></i>

<?php 
    include "../master/sections/mid2.php";
?>

<div class="data">
    <div class="page-title">Dashboard</div>

    <!-- page content -->
    <div class="widgets">
        <?php
            $patients_count = $conn -> query("SELECT COUNT(pat_id) AS 'pat_count' 
            FROM patients;") -> fetchAll(PDO::FETCH_COLUMN);

            $treat_count = $conn -> query("SELECT COUNT(treat_id) 
            FROM treat_doctors;") -> fetchAll(PDO::FETCH_COLUMN);

            $emp_count = $conn -> query("SELECT COUNT(emp_id) 
            FROM employees;") -> fetchAll(PDO::FETCH_COLUMN);

            $total_income = $conn -> query("SELECT SUM(invoice_total) 
            FROM invoices") -> fetchAll(PDO::FETCH_COLUMN);

            $last_date = $conn -> query("SELECT invoice_date FROM invoices
            ORDER BY invoice_id DESC LIMIT 1") -> fetchAll(PDO::FETCH_COLUMN);
        ?>

        <div class="widget-no1">
            <span>Patients</span>
            <span><?php echo $patients_count[0]; ?></span>
        </div>
        <div class="widget-no2">
            <span>Treatment Doctors</span>
            <span><?php echo $treat_count[0]; ?></span>
        </div>
        <div class="widget-no3">
            <span>Employees</span>
            <span><?php echo $emp_count[0]; ?></span>
        </div>
        <div class="widget-no4">
            <span>Total Income</span>
            <span><?php echo $total_income[0] . " LE"; ?></span>
        </div>
        <div class="widget-no5">
            <span>Last Invoice Date</span>
            <span><?php echo $last_date[0]; ?></span>
        </div>
    </div>

</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- js here -->


<?php
    include "../master/sections/end.php";
?>
