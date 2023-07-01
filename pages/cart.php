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
    <div class="page-title"><?php echo $_SESSION['user'] ;?> Cart</div>

    <!-- page content -->
    <!-- <div class="search-add">
        <div class="search-box">
            <input type="search" id="exam" placeholder="search examination">
        </div>
        <div class="add-box">
            <a href="addexam.php">Add Examination</a>
        </div>
    </div> -->
    <div class="tab">
    <table>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Image</th>
                <th>Price</th>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
            <?php
                $userid = $_SESSION['userid'];
                $get_items = $conn -> query("SELECT item_id, item_name, item_price, item_photo
                FROM cart INNER JOIN items USING(item_id)
                WHERE cart.user_userid = $userid ");
                while($row = $get_items->fetch()):
            ?>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <tr>
                        <td><?php echo $row['item_id']; ?></td>
                        <td><?php echo $row['item_name']; ?></td>
                        <td>
                            <img src="<?php echo $row['item_photo']; ?>" class="image-cart">
                        </td>
                        <td><?php echo $row['item_price']; ?></td>
                        <td class="trash">
                            <form action="delcart.php" method="GET">
                                <input type="hidden" name="item-id" value="<?php echo $row['item_id']; ?>">
                                <button>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>

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
