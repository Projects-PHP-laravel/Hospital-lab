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
    <div class="page-title">Departments</div>

    <!-- page content -->
    <div class="search-add">
        <div class="search-box">
            <input type="search" id="dept" placeholder="search department">
        </div>
        <div class="add-box">
            <a href="adddept.php">Add Department</a>
        </div>
    </div>
    <div class="tab">
        <table>
            <tr>
                <th>Department ID</th>
                <th>Department</th>
                <th>Added BY</th>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
            <?php
                $get_jobs = $conn -> query("SELECT dept_id, dept_name, user_username
                FROM departments INNER JOIN users USING(user_userid)");
                while($row = $get_jobs->fetch()):
            ?>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <tr>
                        <td><?php echo $row['dept_id']; ?></td>
                        <td><?php echo $row['dept_name']; ?></td>
                        <td><?php echo $row['user_username']; ?></td>
                        <td class="e">
                            <form action="editdept.php" method="GET">
                                <input type="hidden" name="dept-id" value="<?php echo $row['dept_id']; ?>">
                                <button>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="deldept.php" method="GET">
                                <input type="hidden" name="dept-id" value="<?php echo $row['dept_id']; ?>">
                                <button>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><?php echo $row['dept_id']; ?></td>
                        <td><?php echo $row['dept_name']; ?></td>
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
