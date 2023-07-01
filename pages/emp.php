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
    <div class="page-title">Employees</div>

    <!-- page content -->
    <div class="search-add">
        <div class="search-box">
            <input type="search" id="emp" placeholder="search employee">
        </div>
        <div class="add-box">
            <a href="addemp.php">Add Employee</a>
        </div>
    </div>
    <div class="tab">
    <table>
            <tr>
                <th>Employee</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Hire Date</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Added BY</th>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
            <?php
                $get_employees = $conn -> query("SELECT emp_id, emp_name, job_title, dept_name, salary,
                hire_date, emp_age, emp_gender, user_username
                FROM (((employees
                        INNER JOIN jobs USING(job_id))
                        INNER JOIN departments USING(dept_id))
                        INNER JOIN users ON employees.user_userid = users.user_userid)");
                while($row = $get_employees->fetch()):
            ?>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <tr>
                        <td><?php echo $row['emp_name']; ?></td>
                        <td><?php echo $row['job_title']; ?></td>
                        <td><?php echo $row['dept_name']; ?></td>
                        <td><?php echo $row['salary']; ?></td>
                        <td><?php echo $row['hire_date']; ?></td>
                        <td><?php echo $row['emp_age']; ?></td>
                        <td><?php echo $row['emp_gender']; ?></td>
                        <td><?php echo $row['user_username']; ?></td>
                        <td class="e">
                            <form action="editemp.php" method="GET">
                                <input type="hidden" name="emp-id" value="<?php echo $row['emp_id']; ?>">
                                <button>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="delemp.php" method="GET">
                                <input type="hidden" name="emp-id" value="<?php echo $row['emp_id']; ?>">
                                <button>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><?php echo $row['emp_name']; ?></td>
                        <td><?php echo $row['job_title']; ?></td>
                        <td><?php echo $row['dept_name']; ?></td>
                        <td><?php echo $row['salary']; ?></td>
                        <td><?php echo $row['hire_date']; ?></td>
                        <td><?php echo $row['emp_age']; ?></td>
                        <td><?php echo $row['emp_gender']; ?></td>
                        <td><?php echo $row['user_username']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php  endwhile; ?>
        </table>
    </div>

</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- js here -->


<?php
    include "../master/sections/end.php";
?>
