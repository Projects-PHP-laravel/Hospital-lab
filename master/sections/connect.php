<?php
$hostName = "localhost";
$dbname = "heart_sept_2022";
$username = "root";
$password = "";

try{
    $conn =  new PDO("mysql:host=$hostName;dbname=$dbname", $username, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
    echo $e -> getMessage();
}

// class with 2 cols connect
class Conn_2_cols{
    
    public $column_one;
    public $column_two;
    public $table_name;

    function __construct($c1, $c2, $t){
        $this -> column_one = $c1; 
        $this -> column_two = $c2; 
        $this -> table_name = $t; 
    }

    public function getRecords(){
        $records = $GLOBALS['conn'] -> query("SELECT $this->column_one, 
        $this->column_two FROM $this->table_name") -> fetchAll(PDO::FETCH_KEY_PAIR);
        return $records;
    } 

    public function printRecords(){
        echo "<pre>";
        print_r($this->getRecords());
        echo "</pre>";
    }

    public function data_select(){
        foreach( $this->getRecords() as $key => $value ){
            echo "<option value=\"$key\">$value</option>";
        }
    }

}

class Table_view{
    public $view_name; 
    public $p_k; 
    public $link_name;
    public $actual_name;

    function __construct($v_n, $pk, $l_n, $a_a){
        $this -> view_name = $v_n;
        $this -> p_k = $pk;
        $this -> link_name = $l_n;
        $this -> actual_name= $a_a;
    }


    public function view_records(){
        $all_records = $GLOBALS['conn'] -> query("SELECT * 
        FROM $this->view_name") -> fetchAll(PDO::FETCH_ASSOC);
        return $all_records;
    }

    public function print_view_records(){
        echo "<pre>";
        print_r($this->view_records());
        echo "</pre>";
    } 

    public function full_records_tab(){
        for( $i = 0; $i < count($this->view_records()); $i++ ){
            echo "<tr>";
                foreach( $this->view_records()[$i] as $key => $value){
                    echo "<td>" . $value . "</td>";
                }

                echo '<td class="e">'
                    . '<form action="edit'.$this->link_name . '.php" method="GET">'
                    . '    <input type="hidden" name="' . $this->p_k. '" value="'. $this->p_k. '">'
                    . '<button><i class="fas fa-edit"></i></button>'
                    .'</td>';

                echo '<td class="trash">'
                . '<form action="del'.$this->link_name . '.php" method="GET">'
                . '    <input type="hidden" name="' . $this->p_k. '" value="'. $this->p_k. '">'
                . '<button><i class="fa fa-trash"></i></button>'
                .'</td>';

            echo "</tr>";
        }
    }
}


// objects with class Conn_2_cols
$section_table = new Conn_2_cols("section_id", "section_name", "sections");
$treat_table = new Conn_2_cols("treat_id", "treat_name", "treat_doctors");
$job_table = new Conn_2_cols("job_id", "job_title", "jobs");
$dept_table = new Conn_2_cols("dept_id", "dept_name", "departments");
$exam_table = new Conn_2_cols("exam_id", "exam_name", "examinations");
$pat_table = new Conn_2_cols("pat_id", "pat_name", "patients");

// object wth class Table_view
$section_view = new Table_view("sections_tab", "section_id", "section", "sections");
$treat_view = new Table_view("treat_tab", "treat_id", "treat", "treat_doctors");
$pat_view = new Table_view("pat_tab", "pat_id", "pat", "patients");
$job_view = new Table_view("job_tab", "job_id", "job", "jobs");
$dept_view = new Table_view("dept_tab", "dept_id", "dept", "departments");
$emp_view = new Table_view("emp_tab", "emp_id", "emp", "employees");
$exam_view = new Table_view("exam_tab", "exam_id", "exam", "examinations");