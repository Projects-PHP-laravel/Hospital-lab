<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";
?>
        <?php
            $user_ID = $_SESSION['userid'];
            $user_items = $conn -> query("SELECT item_id FROM cart 
            WHERE user_userid = $user_ID ") -> fetchAll(PDO::FETCH_COLUMN);
            $get_items = $conn -> query("SELECT * FROM items");
            while($row = $get_items->fetch()):
        ?>
            <div>
                <img src="<?php echo $row['item_photo'] ;?>" alt="">
                <div class="item-name"><?php echo $row['item_name'] ;?></div>
                <div class="item-price"><?php echo $row['item_price'] . " ج م" ;?></div>
                <div class="cart-box">
                    <input type="hidden" class="item-id" value="<?php echo $row['item_id'] ;?>">
                    <?php if( in_array($row['item_id'] , $user_items) ):?>  
                        <span class="rem" id="remove">remove To Cart</span>
                    <?php else:?>
                        <span class="ad" id="add">Add To Cart</span>
                    <?php endif;?>
                </div>
            </div>
        <?php endwhile;?>
