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
    <div class="page-title">Sections</div>
    <!-- page content -->
    <div class="search-add">
        <div class="search-box">
            <input type="search" id="section" placeholder="search section">
        </div>
        <div class="add-box">
            <a href="addsection.php">Add Section</a>
        </div>
    </div>
    <div class="tab">
        <table>
            <tr>
                <th>Section ID</th>
                <th>Section Name</th>
                <th>Added BY</th>
                <?php if($_SESSION['usertype'] == "admin"): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
            <?php
                if($_SESSION['usertype'] == "admin"){
                    $section_view -> full_records_tab();
                }
                else{
                    
                }
            ?>
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
