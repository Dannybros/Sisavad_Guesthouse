<?php
    include_once ("../config/dbconnect.php");

   
    $return_arr = array();

    if(isset($_GET['search'])){
        $q = $_GET['search'];
        $search_qqq = explode("*", $q);
        $t = $search_qqq[0];
        $s = $search_qqq[1];

        if($t==="all"){
            $query = "SELECT * FROM `room` NATURAL JOIN `room_type` WHERE `room_name` LIKE '%$s%' OR `room_status` LIKE '%$s%' ORDER BY room_name;";
        }else{
            $query = "SELECT * FROM `room` NATURAL JOIN `room_type` WHERE `room_type_id` = '$t' AND (`room_name` LIKE '%$s%' OR `room_status` LIKE '%$s%')"; 
        }
    }

    if(isset($_GET['id'])){

        $id = $_GET['id'];
        $query = "SELECT * FROM `room` NATURAL JOIN `room_type` WHERE `room_id` = '$id'";
    }

    if(isset($_GET['typeID'])){

        $id = $_GET['typeID'];
        $query = "SELECT * FROM `room` NATURAL JOIN `room_type` WHERE `room_type_id` = '$id' AND `room_status` = 'Free'";
    }

    if(isset($_GET['free'])){
        
        $id = $_POST['type'];
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        
        $query = "SELECT * FROM `room` NATURAL JOIN `room_type` WHERE `room_id` NOT IN (SELECT `booked_room` FROM `booking` WHERE `date_in` BETWEEN '$checkIn' AND '$checkOut') AND `room_type_id` = '$id'";
    }

    if(isset($_GET['all'])){
        $query = "SELECT * FROM `room` NATURAL JOIN `room_type`";
    }

    $result = mysqli_query($conn, $query);

    while ($rooms = mysqli_fetch_array($result)) {
        $id=$rooms['room_id'];
        $name=$rooms['room_name'];
        $type=$rooms['room_type_name'];
        $typeID=$rooms['room_type_id'];
        $status=$rooms['room_status'];
        $price=$rooms['price'];
        
        $return_arr[] = array(
            "id" => $id,
            "name" => $name,
            "type"=>$type,
            "typeID"=>$typeID,
            "status" => $status,
            "price"=>$price,
        );
    }

    // echo mysqli_error($conn);
    echo json_encode($return_arr);

    exit();
?>