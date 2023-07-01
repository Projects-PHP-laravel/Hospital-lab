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
    <div class="page-title">Add Job</div>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="job" placeholder="job title">
            <input type="submit" value="Save">
        </form>
    </div>

    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $job = $_POST['job'];
            $userID = $_SESSION['userid'];
            if( empty($job) ){
                echo '<div class="error">Enter job title to save job.</div>';
            }
            else{
                $stmt = $conn -> prepare("INSERT INTO jobs(job_title, user_userid)
                VALUES(?,?)");
                $stmt -> execute([$job, $userID]);
                header("location:job.php");
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
