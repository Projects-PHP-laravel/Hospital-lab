<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    $pat_info = $conn -> query("SELECT * FROM pat_tab") -> fetchAll(PDO::FETCH_ASSOC);
    $json_text = json_encode($pat_info);
    file_put_contents("pat.json", $json_text);
    include "../master/sections/start.php";
    include "../master/sections/alinks.php";
    include "../master/sections/mid1.php";
?>
<?php echo $_SESSION['user'] ;?> <i class="fas fa-chevron-down" id="icon-arrow"></i>

<?php 
    include "../master/sections/mid2.php";
?>

<div class="data">
    <div class="page-title">Invoice</div>

    <!-- page content -->
    <div class="inv">
        <form action="invo.php" method="POST">
            <table>
                <!-- invoice head -->
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>
                            <select name="pat" id="pat-id">
                                <option value="start">Select Patient</option>
                                <?php
                                    // $pat_records = $conn -> query("SELECT pat_id, pat_name 
                                    // FROM patients") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                    // foreach( $pat_records as $key => $value ){
                                    //     echo '<option value="' . $key . '">' . $value . '</option>';
                                    // }

                                    $pat_records = $conn -> query("SELECT pat_name 
                                    FROM patients ORDER BY pat_id") -> fetchAll(PDO::FETCH_COLUMN);
                                    for($i = 0; $i < count($pat_records); $i++){
                                        echo '<option value="' . $i . '">' . $pat_records[$i] . "</option>";
                                    }
                                ?>
                            </select>
                        </th>
                        <th></th>
                        <th>Invoice ID</th>
                        <th>
                            <?php
                                $get_invo_id = $conn -> query("SELECT invoice_id FROM invoices 
                                ORDER by invoice_id DESC LIMIT 1") -> fetchAll(PDO::FETCH_COLUMN);
                                $invoice_last_id = (count($get_invo_id) > 0) ? $get_invo_id[0] + 1 : 1; 
                            ?>
                            <input type="number" name="inv-id" readonly value="<?php echo $invoice_last_id; ?>">
                        </th>
                    </tr>

                    <tr>
                        <th>Mobile</th>
                        <th id="mob"></th>
                        <th></th>
                        <th>Invoice Date</th>
                        <th>
                            <input type="text" name="inv-date" id="invoice-date" readonly>
                        </th>
                    </tr>

                    <tr>
                        <th>Age</th>
                        <th id="age"></th>
                        <th></th>
                        <th>Invoice Time</th>
                        <th>
                            <input type="text" name="inv-time" id="invoice-time" readonly>
                        </th>
                    </tr>
                    <!-- row as space -->
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <!-- invoice details -->
                <tbody>
                    <tr>
                        <th colspan="2">Examinations</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="exam[]" id="exam-id">
                            <option value="start">Select Examination</option>
                                <?php
                                    // $exam_records = $conn -> query("SELECT exam_id, exam_name 
                                    // FROM examinations") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                    // foreach( $exam_records as $key => $value ){
                                    //     echo '<option value="' . $key . '">' . $value . '</option>';
                                    // }

                                    $exam_table -> data_select();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0"> 
                        </td>
                        <td>
                            <input type="number" name="amount" class="a" readonly value="0">  
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="exam[]" id="exam-id">
                            <option value="start">Select Examination</option>
                                <?php
                                    // foreach( $exam_records as $key => $value ){
                                    //     echo '<option value="' . $key . '">' . $value . '</option>';
                                    // }

                                    $exam_table -> data_select();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0"> 
                        </td>
                        <td>
                            <input type="number" name="amount" class="a" readonly value="0">  
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="exam[]" id="exam-id">
                            <option value="start">Select Examination</option>
                                <?php
                                    // foreach( $exam_records as $key => $value ){
                                    //     echo '<option value="' . $key . '">' . $value . '</option>';
                                    // }

                                    $exam_table -> data_select();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0"> 
                        </td>
                        <td>
                            <input type="number" name="amount" class="a" readonly value="0">  
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="exam[]" id="exam-id">
                            <option value="start">Select Examination</option>
                                <?php
                                    // foreach( $exam_records as $key => $value ){
                                    //     echo '<option value="' . $key . '">' . $value . '</option>';
                                    // }

                                    $exam_table -> data_select();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0"> 
                        </td>
                        <td>
                            <input type="number" name="amount" class="a" readonly value="0">  
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="exam[]" id="exam-id">
                            <option value="start">Select Examination</option>
                                <?php
                                    // foreach( $exam_records as $key => $value ){
                                    //     echo '<option value="' . $key . '">' . $value . '</option>';
                                    // }

                                    $exam_table -> data_select();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0"> 
                        </td>
                        <td>
                            <input type="number" name="amount" class="a" readonly value="0">  
                        </td>
                    </tr>

                    <tr>
                        <th colspan="4" class="th-r">Total</th>
                        <td>
                            <input type="number" name="total" id="to" value="0" readonly>
                        </td>
                    </tr>
                </tbody>

                <!-- invoice footer -->
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Employee</th>
                        <th></th>
                        <th>Treatment Doctor</th>
                        <th></th>
                        <th>Examination Doctor</th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $_SESSION['user']; ?>
                        </td>
                        <td></td>
                        <td id="t-d"></td>
                        <td></td>
                        <td>
                            <select name="emp">
                                <?php
                                    $emp_records = $conn -> query("SELECT emp_id, emp_name 
                                    FROM employees WHERE job_id = 2") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                    foreach( $emp_records as $key => $value ){
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <input type="submit" value="Save">
        </form>
    </div>

</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- js here -->
<script src="../master/js/invoice.js"></script>

<?php
    include "../master/sections/end.php";
?>
