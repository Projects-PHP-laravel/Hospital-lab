<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    $inp_val = $_GET['q'];
?>

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
        WHERE treat_phone LIKE '$inp_val%'");
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