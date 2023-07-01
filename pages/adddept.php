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
    <div class="page-title">Add Department</div>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="dept" placeholder="department name">
            <input type="submit" value="Save">
        </form>
    </div>

    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $dept = $_POST['dept'];
            $userID = $_SESSION['userid'];
            if( empty($dept) ){
                echo '<div class="error">Enter date to save department.</div>';
            }
            else{
                $stmt = $conn -> prepare("INSERT INTO departments(dept_name, user_userid)
                VALUES(?,?)");
                $stmt -> execute([$dept, $userID]);
                header("location:dept.php");
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
