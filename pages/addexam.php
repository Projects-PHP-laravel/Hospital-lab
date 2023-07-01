<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
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
    <div class="page-title">Add Examination</div>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="exam" placeholder="examination name">
            <input type="number" name="price" placeholder="examination price">
            <input type="submit" value="Save">
        </form>
    </div>

    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $exam = $_POST['exam'];
            $price = $_POST['price'];
            $userID = $_SESSION['userid'];
            if( empty($exam) || empty($price)){
                echo '<div class="error">Enter date to save examination.</div>';
            }
            else{
                $stmt = $conn -> prepare("INSERT INTO examinations(exam_name, exam_price, user_userid)
                VALUES(?,?,?)");
                $stmt -> execute([$exam, $price, $userID]);
                header("location:exam.php");
            }
        }
    ?>
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- js here -->


<?php
    include "../master/sections/end.php";
?>
