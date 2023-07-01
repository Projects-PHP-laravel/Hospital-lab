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
    <div class="page-title">Add Treatment Doctor</div>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="treat" placeholder="doctor name">
            <input type="text" name="mob" placeholder="doctor phone">
            <input type="text" name="address" placeholder="doctor address">
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <select name="section">
                <?php
                    // $get_sections_records = $conn -> query("SELECT section_id, section_name
                    // FROM sections") -> fetchAll(PDO::FETCH_KEY_PAIR);
                    // foreach( $get_sections_records as $key => $value ){
                    //     echo "<option value=\"$key\">$value</option>";
                    // }

                    $section_table -> data_select();
                ?>
            </select>
            <input type="submit" value="Save">
        </form>
    </div>

    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $treat = $_POST['treat'];
            $phone = $_POST['mob'];
            $address = $_POST['address'];
            $gedner = $_POST['gender'];
            $section_ID = $_POST['section'];
            $userID = $_SESSION['userid'];
            if( empty($treat) || empty($phone) || empty($address) ){
                echo '<div class="error">Enter Data to save treatment doctor.</div>';
            }
            else{
                $stmt = $conn -> prepare("INSERT INTO treat_doctors(treat_name, treat_address,
                treat_phone, treat_gender, section_id, user_userid)
                VALUES(?,?,?,?,?,?)");
                $stmt -> execute([$treat, $address, $phone, $gedner, $section_ID, $userID]);
                header("location:treat.php");
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
