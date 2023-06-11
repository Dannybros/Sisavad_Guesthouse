<?php
    include_once ("../config/dbconnect.php");

    $booking_ID = $_GET['id'];
    $roomID = $_POST['roomID'];
    $status = $_POST['status'];
    $time = $_POST['time'];

    if(isset($_GET['checkIn'])){
        $sql="INSERT INTO `room_log`(`booking_id`, `room_id`, `time`, `action`, `memo`) VALUES ('$booking_ID','$roomID','$time','$status','');
        UPDATE `booking` SET `booking_status`='Staying' WHERE `booking_id`='$booking_ID';
        UPDATE `room` SET `room_status`='Occupied' WHERE `room_id`='$roomID';";
    } 
    else if (isset($_GET['checkOut'])){
        $sql="INSERT INTO `room_log`(`booking_id`, `room_id`, `time`, `action`, `memo`) VALUES ('$booking_ID', '$roomID', '$time', '$status', '');
        UPDATE `room` SET `room_status`='Free',`booking_id`= null WHERE `room_id`='$roomID';
        UPDATE `booking` SET `booking_status`='Finished' WHERE `booking_id`='$booking_ID';";
    }
    else if(isset($_GET['move'])) {
        $prevRoomID = $_POST['prevRoom'];
        $memo = $_POST['memo'];
        $sql="INSERT INTO `room_log`(`booking_id`, `room_id`, `old_room_id`, `time`, `action`, `memo`) VALUES ('$booking_ID', '$roomID', '$prevRoomID', '$time', '$status', '$memo');
            UPDATE `room` SET `room_status`='Booked',`booking_id`='$booking_ID' WHERE `room_id`='$roomID';
            UPDATE `room` SET `room_status`='Free',`booking_id`= null WHERE `room_id`='$prevRoomID';
        ";
    }
    else if(isset($_GET['cancel'])){
        $memo = $_POST['memo'];
        $sql="INSERT INTO `room_log`(`booking_id`, `room_id`, `time`, `action`, `memo`) VALUES ('$booking_ID','$roomID','$time','$status','$memo');
        UPDATE `booking` SET `booking_status`='$status' WHERE `booking_id`='$booking_ID';
        UPDATE `room` SET `room_status`='Free',`booking_id`= null WHERE `room_id`='$roomID';";
    }
    
    $result = mysqli_multi_query($conn, $sql);

    if ($result) {
        echo "success";
        exit();
    }else {
        echo mysqli_error($conn);
        exit();
    }
?>