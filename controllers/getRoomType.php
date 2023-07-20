<?php
    include_once ("../config/dbconnect.php");

   
    $return_arr = array();

    $query = "SELECT * FROM `room_type`";

    $result = mysqli_query($conn, $query);

    while ($rooms = mysqli_fetch_array($result)) {
        $id=$rooms['room_type_id'];
        $name=$rooms['room_type_name'];
        $price=$rooms['price'];
        
        $return_arr[] = array(
            "id" => $id,
            "name" => $name,
            "price"=>$price,
        );
    }

    echo json_encode($return_arr);

    exit();
?>