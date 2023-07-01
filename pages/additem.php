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
    <div class="page-title">Add Item</div>

    <div class="f1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input type="text" name="item" placeholder="item name">
            <input type="number" name="price" placeholder="item price">
            <input type="number" name="quantity" placeholder="item quantity">
            <br><br>
            <input type="file" name="item-image">
            <br><br>
            <input type="submit" value="Save">
        </form>
    </div>

    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $item = $_POST['item'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $uploaded_image = $_FILES['item-image'];
            $userID = $_SESSION['userid'];
            if( empty($item) || empty($price) || empty($quantity) || empty($uploaded_image)){
                echo '<div class="error">Enter Data to save Item.</div>';
            }
            else{
                $upload_path =  __DIR__ . "/" . "images/" . $uploaded_image['name'];
                $image_path = "images/" . $uploaded_image['name'];
                $extensions = array("jpg", "png", "gif", "jpeg");
                $image_extension = pathinfo($uploaded_image['name'])['extension'];
                if( !in_array($image_extension, $extensions) ){
                    echo '<div class="error">This file is not an image.</div>';
                }
                else{ 
                    move_uploaded_file($uploaded_image['tmp_name'], $upload_path);;
                    $stmt = $conn -> prepare("INSERT INTO items(item_name, item_price, item_quantity,
                     item_photo)VALUE(?,?,?,?)");
                    $stmt -> execute([$item, $price, $quantity, $image_path]);
                    header("location:item.php");
                }
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
