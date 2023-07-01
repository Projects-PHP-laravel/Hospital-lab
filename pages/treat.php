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
    <div class="page-title">Treatment Doctors</div>

    <!-- page content -->
    <div class="search-add">
        <div class="search-box">
            <input type="search" id="treat" placeholder="search doctor">
        </div>
        <div class="add-box">
            <a href="addtreat.php">Add Doctor</a>
        </div>
    </div>
    <div class="tab" id="search-result">
        <table>
            <tr>
                <th>Doctor</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Section</th>
                <th>Added BY</th>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
            <?php
                $get_treat = $conn -> query("SELECT treat_id, treat_name, treat_address, treat_phone,
                treat_gender, section_name, user_username
                FROM ((treat_doctors 
                       INNER JOIN sections USING(section_id))
                       INNER JOIN users ON treat_doctors.user_userid = users.user_userid)
                WHERE column_active = 1");
                while($row = $get_treat->fetch()):
            ?>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <tr>
                        <td><?php echo $row['treat_name']; ?></td>
                        <td><?php echo $row['treat_phone']; ?></td>
                        <td><?php echo $row['treat_address']; ?></td>
                        <td><?php echo $row['treat_gender']; ?></td>
                        <td><?php echo $row['section_name']; ?></td>
                        <td><?php echo $row['user_username']; ?></td>
                        <td class="e">
                            <form action="edittreat.php" method="GET">
                                <input type="hidden" name="treat-id" value="<?php echo $row['treat_id']; ?>">
                                <button>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="deltreat.php" method="GET">
                                <input type="hidden" name="treat-id" value="<?php echo $row['treat_id']; ?>">
                                <button>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><?php echo $row['treat_name']; ?></td>
                        <td><?php echo $row['treat_phone']; ?></td>
                        <td><?php echo $row['treat_address']; ?></td>
                        <td><?php echo $row['treat_gender']; ?></td>
                        <td><?php echo $row['section_name']; ?></td>
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
<script src="../master/js/search.js"></script>

<?php
    include "../master/sections/end.php";
?>
