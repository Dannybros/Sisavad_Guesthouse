<?php
    include_once ("../config/dbconnect.php");
        session_start();

    if (isset($_GET['id'])){

        $id = $_GET['id'];

        $query = "SELECT * FROM `customer` WHERE `cust_id` = '$id'";
        $result = mysqli_query($conn, $query);
        $cust_info = mysqli_fetch_assoc($result);

        echo json_encode($cust_info);  
        exit();       

    }else if (isset($_GET['all'])){

        $query = "SELECT * FROM `customer`";
        $result = mysqli_query($conn, $query);
        $data = [];

        while ($row = mysqli_fetch_array($result)) {
            $data[] = $row;  
        }

        echo json_encode($data); 
        exit();        
    }
            
    
?>