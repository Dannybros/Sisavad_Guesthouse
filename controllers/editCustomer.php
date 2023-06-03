<?php
    include_once ("../config/dbconnect.php");

    $cust_ID = $_POST['cust_id'];
    $cust_name = $_POST['cust_name'];
    $cust_fname = $_POST['cust_fname'];
    $contact = $_POST['cust_contact'];
    $email = $_POST['cust_email'];
    $passport = $_POST['cust_id_passport'];
    $bd = $_POST['cust_bd'];

    $sql="UPDATE `customer` SET `cust_name`='$cust_name', `cust_firstname`='$cust_fname', `cust_bd`='$bd', `contact`='$contact', `email`='$email', `passport`='$passport' WHERE `cust_id` = '$cust_ID'";
    $result = mysqli_query($conn, $sql);
    
    if ($result){
        echo "success";
        exit();
    }else{
        echo mysqli_error($conn);
        exit();
    }
        
?>