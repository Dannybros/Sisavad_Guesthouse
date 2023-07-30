<?php
    include_once ("../config/dbconnect.php");
   
    $return_arr = array();

    $query = "SELECT * FROM `employee`";

    $result = mysqli_query($conn, $query);

    while ($staff = mysqli_fetch_array($result)) {
        $id=$staff['emp_ID'];
        $name=$staff['emp_Name'];
        $gender=$staff['gender'];
        $bd=$staff['emp_bd'];
        $ID_Card=$staff['emp_ID_Card'];
        $phone=$staff['phone'];
        $email=$staff['email'];
        $position=$staff['position'];
        $salary=$staff['salary'];
        
        $return_arr[] = array(
            "id" => $id,
            "name" => $name,
            "gender" => $gender,
            "bd" => $bd,
            "phone" => $phone,
            "email" => $email,
            "position" => $position,
            "salary" => $salary,
            "ID_Card"=>$ID_Card,
        );
    }

    echo json_encode($return_arr);

    exit();
?>