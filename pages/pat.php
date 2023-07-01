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
    <div class="page-title">Patients</div>

    <!-- page content -->
    <div class="search-add">
        <div class="search-box">
            <input type="search" id="pat" placeholder="search patient">
        </div>
        <div class="add-box">
            <a href="addpat.php">Add Patient</a>
        </div>
    </div>
    <div class="tab">
        <table>
            <tr>
                <th>Patient</th>
                <th>Mobile</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Treatment Doctor</th>
                <th>Added BY</th>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
            <?php
                $get_patients = $conn -> query("SELECT pat_id, pat_name, pat_phone, pat_age,
                pat_gender, treat_name, user_username
                FROM ((patients
                       INNER JOIN treat_doctors USING(treat_id))
                       INNER JOIN users ON patients.user_userid = users.user_userid)");
                while($row = $get_patients->fetch()):
            ?>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <tr>
                        <td><?php echo $row['pat_name']; ?></td>
                        <td><?php echo $row['pat_phone']; ?></td>
                        <td><?php echo $row['pat_age']; ?></td>
                        <td><?php echo $row['pat_gender']; ?></td>
                        <td><?php echo $row['treat_name']; ?></td>
                        <td><?php echo $row['user_username']; ?></td>
                        <td class="e">
                            <form action="editpat.php" method="GET">
                                <input type="hidden" name="pat-id" value="<?php echo $row['pat_id']; ?>">
                                <button>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="delpat.php" method="GET">
                                <input type="hidden" name="pat-id" value="<?php echo $row['pat_id']; ?>">
                                <button>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><?php echo $row['pat_name']; ?></td>
                        <td><?php echo $row['pat_phone']; ?></td>
                        <td><?php echo $row['pat_age']; ?></td>
                        <td><?php echo $row['pat_gender']; ?></td>
                        <td><?php echo $row['treat_name']; ?></td>
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
