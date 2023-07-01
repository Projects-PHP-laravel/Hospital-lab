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
    <div class="page-title">Add Employees</div>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <span>Employee Name:</span>
                <input type="text" name="emp" placeholder="employee name">
            </div>
            <div>
                <span>Job Title:</span>
                <select name="job">
                    <?php
                        // $get_job_records = $conn -> query("SELECT job_id, job_title
                        // FROM jobs") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        // foreach( $get_job_records as $key => $value ){
                        //     echo "<option value=\"$key\">$value</option>";
                        // }

                        $job_table -> data_select(); 
                    ?>
                </select>
            </div>
            <div>
                <span>Department:</span>
                <select name="dept">
                    <?php
                        // $get_dept_records = $conn -> query("SELECT dept_id, dept_name
                        // FROM departments") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        // foreach( $get_dept_records as $key => $value ){
                        //     echo "<option value=\"$key\">$value</option>";
                        // }

                        $dept_table -> data_select(); 
                    ?>
                </select>
            </div>            
            <div>
                <span>Salary:</span>
                <input type="number" name="salary" placeholder="employee salary">
            </div>
            <div>
                <span>Hire Date:</span>
                <input type="date" name="hd">
            </div>
            <div>
                <span>Age:</span>
                <input type="number" name="age" placeholder="employee age">
            </div>
            <div>
                <span>Gender:</span>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                 </select>

            </div>           
            <input type="submit" value="Save">
        </form>
    </div>

    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $emp = $_POST['emp'];
            $job = $_POST['job'];
            $dept = $_POST['dept'];
            $salary = $_POST['salary'];
            $hd = $_POST['hd'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $userID = $_SESSION['userid'];
            if( empty($emp) || empty($salary) || empty($age) || empty($hd)){
                echo '<div class="error">Enter Data to save employee.</div>';
            }
            else{
                $stmt = $conn -> prepare("INSERT INTO employees(emp_name, job_id, dept_id, salary,
                hire_date, emp_age, emp_gender, user_userid)
                VALUES(?,?,?,?,?,?,?,?)");
                $stmt -> execute([$emp, $job, $dept, $salary, $hd, $age, $gender, $userID]);
                header("location:emp.php");
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
