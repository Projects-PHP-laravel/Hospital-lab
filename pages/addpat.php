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
    <div class="page-title">Add Patient</div>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="pat" placeholder="patient name">
            <input type="text" name="mob" placeholder="patient phone">
            <input type="number" name="age" placeholder="patient age">
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <select name="treat">
                <?php
                    // $get_treat_records = $conn -> query("SELECT treat_id, treat_name
                    // FROM treat_doctors") -> fetchAll(PDO::FETCH_KEY_PAIR);
                    // foreach( $get_treat_records as $key => $value ){
                    //     echo "<option value=\"$key\">$value</option>";
                    // }

                    $treat_table -> data_select();
                ?>
            </select>
            <input type="submit" value="Save">
        </form>
    </div>

    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $patient = $_POST['pat'];
            $phone = $_POST['mob'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $treat_ID = $_POST['treat'];
            $userID = $_SESSION['userid'];
            if( empty($patient) || empty($phone) || empty($age) ){
                echo '<div class="error">Enter Data to save Patient.</div>';
            }
            else{
                $stmt = $conn -> prepare("INSERT INTO patients(pat_name, pat_phone,
                pat_age, pat_gender, treat_id, user_userid)
                VALUES(?,?,?,?,?,?)");
                $stmt -> execute([$patient, $phone, $age, $gender, $treat_ID, $userID]);
                header("location:pat.php");
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
