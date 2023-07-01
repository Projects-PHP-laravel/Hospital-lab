<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        $section = $_POST['section'];
        $sec_id = $_POST['sec-id'];
        $userID = $_SESSION['userid'];
        if( empty($section) ){
            echo '<div class="error">Enter section name to save section.</div>';
        }
        else{
            $stmt = $conn -> prepare("REPLACE INTO sections(section_id,section_name, user_userid)
            VALUES(?,?,?)");
            $stmt -> execute([$sec_id,$section, $userID]);
            header("location:sections.php");
        }
    }
    include "../master/sections/start.php";
    include "../master/sections/alinks.php";
    include "../master/sections/mid1.php";
?>
<?php echo $_SESSION['user'] ;?> <i class="fas fa-chevron-down" id="icon-arrow"></i>

<?php 
    include "../master/sections/mid2.php";
?>

<div class="data">
    <div class="page-title">Edit Section</div>
    <?php
        $section_ID = $_GET['section_id'];
        $get_id_info = $conn -> query("SELECT * FROM
        sections WHERE section_id = $section_ID") -> fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($get_id_info);
        // echo "</pre>";
    ?>
    <div class="f1">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="hidden" name="sec-id" value="<?php echo $get_id_info[0]['section_id'] ?>">
            <input type="text" name="section" placeholder="section name" value="<?php echo $get_id_info[0]['section_name'] ?>">
            <input type="submit" value="Save">
        </form>
    </div>

    
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- js here -->


<?php
    include "../master/sections/end.php";
?>
