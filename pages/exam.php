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
    <div class="page-title">Examinations</div>

    <!-- page content -->
    <div class="search-add">
        <div class="search-box">
            <input type="search" id="exam" placeholder="search examination">
        </div>
        <div class="add-box">
            <a href="addexam.php">Add Examination</a>
        </div>
    </div>
    <div class="tab">
    <table>
            <tr>
                <th>Examination ID</th>
                <th>Examination</th>
                <th>Price</th>
                <th>Added BY</th>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
            <?php
                $get_jobs = $conn -> query("SELECT exam_id, exam_name, exam_price, user_username
                FROM examinations INNER JOIN users USING(user_userid)");
                while($row = $get_jobs->fetch()):
            ?>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <tr>
                        <td><?php echo $row['exam_id']; ?></td>
                        <td><?php echo $row['exam_name']; ?></td>
                        <td><?php echo $row['exam_price']; ?></td>
                        <td><?php echo $row['user_username']; ?></td>
                        <td class="e">
                            <form action="editexam.php" method="GET">
                                <input type="hidden" name="exam-id" value="<?php echo $row['exam_id']; ?>">
                                <button>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="delexam.php" method="GET">
                                <input type="hidden" name="exam-id" value="<?php echo $row['exam_id']; ?>">
                                <button>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><?php echo $row['exam_id']; ?></td>
                        <td><?php echo $row['exam_name']; ?></td>
                        <td><?php echo $row['exam_price']; ?></td>
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
