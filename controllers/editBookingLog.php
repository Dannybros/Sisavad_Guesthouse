<?php
    include_once ("../config/dbconnect.php");

    $booking_ID = $_GET['id'];
    $roomID = $_POST['roomID'];
    $status = $_POST['status'];
    $time = $_POST['time'];

    if(isset($_GET['checkIn'])){
        $sql="INSERT INTO `booking_log`(`booking_id`, `room_id`, `time`, `booking_status`, `memo`) VALUES ('$booking_ID', '$roomID', '$time', '$status', '');";
        $result = mysqli_query($conn, $sql);
    } 
    else if (isset($_GET['checkOut'])){
        $sql="INSERT INTO `booking_log`(`booking_id`, `room_id`, `time`, `booking_status`, `memo`) VALUES ('$booking_ID', '$roomID', '$time', '$status', '');
        UPDATE `room` SET `room_status`='Free',`booking_id`= null WHERE `room_id`='$roomID';";
        $result = mysqli_multi_query($conn, $sql);
    }
    else if(isset($_GET['move'])) {
        $prevRoomID = $_POST['prevRoom'];
        $memo = $_POST['memo'];
        $sql="INSERT INTO `booking_log`(`booking_id`, `room_id`, `time`, `booking_status`, `memo`) VALUES ('$booking_ID', '$roomID', '$time', '$status', '$memo');
            UPDATE `room` SET `room_status`='Booked',`booking_id`='$booking_ID' WHERE `room_id`='$roomID';
            UPDATE `room` SET `room_status`='Free',`booking_id`= null WHERE `room_id`='$prevRoomID';
        ";
        $result = mysqli_multi_query($conn, $sql);
    }
    
    
    if ($result) {
        echo "success";
        exit();
    }else {
        echo mysqli_error($conn);
        exit();
    }
?>