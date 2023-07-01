<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        $treat = $_POST['treat'];
        $t_ID = $_POST['t-id'];
        $phone = $_POST['mob'];
        $address = $_POST['address'];
        $gedner = $_POST['gender'];
        $section_ID = $_POST['section'];
        $userID = $_SESSION['userid'];
        if( empty($treat) || empty($phone) || empty($address) ){
            echo '<div class="error">Enter Data to save treatment doctor.</div>';
        }
        else{
            $stmt = $conn -> prepare("REPLACE INTO treat_doctors(treat_id, treat_name, treat_address,
            treat_phone, treat_gender, section_id, user_userid)
            VALUES(?,?,?,?,?,?,?)");
            $stmt -> execute([$t_ID,$treat, $address, $phone, $gedner, $section_ID, $userID]);
            header("location:treat.php");
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
    <div class="page-title">Edit Treatment Doctor</div>

    <?php
        $t_id = $_GET['treat-id'];
        $get_id_info = $conn -> query("SELECT * FROM 
        treat_doctors WHERE treat_id = $t_id") -> fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($get_id_info);
        // echo "</pre>";
        $t_g = $get_id_info[0]['treat_gender'];
    ?>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="hidden" name="t-id" value="<?php echo $get_id_info[0]['treat_id'];?>">
            <input type="text" name="treat" placeholder="doctor name" value="<?php echo $get_id_info[0]['treat_name'];?>">
            <input type="text" name="mob" placeholder="doctor phone" value="<?php echo $get_id_info[0]['treat_phone'];?>">
            <input type="text" name="address" placeholder="doctor address" value="<?php echo $get_id_info[0]['treat_address'];?>">
            <select name="gender">
                <option value="male" <?php if($t_g == 'male'){echo 'selected="selected"';} ?>>Male</option>
                <option value="female" <?php if($t_g == 'female'){echo 'selected="selected"';} ?>>Female</option>
            </select>
            <select name="section">
                <?php
                    $get_sections_records = $conn -> query("SELECT section_id, section_name
                    FROM sections") -> fetchAll(PDO::FETCH_KEY_PAIR);
                    foreach( $get_sections_records as $key => $value ){
                       if( $key == $get_id_info[0]['section_id'] ){
                            echo "<option value=\"$key\" selected=\"selected\">$value</option>";
                       }
                       else{
                            echo "<option value=\"$key\">$value</option>";
                       }
                    }
                ?>
            </select>
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
