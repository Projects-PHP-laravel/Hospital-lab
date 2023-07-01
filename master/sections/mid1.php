</div>

<div class="page-data">

    <header>
        <div class="bars" id="go">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="c-n">
            <?php
                $userID = $_SESSION['userid'];
                $fetch_count_items = $conn -> query("SELECT COUNT(item_id)
                FROM cart WHERE user_userid = $userID") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <i class="fa-solid fa-cart-shopping"></i>
            <div id="cart" class="cart-num">
                <?php echo $fetch_count_items[0]; ?>
            </div>
        </div>
        <div class="user-name">
            <ul class="ul-main" id="set">
                <li>