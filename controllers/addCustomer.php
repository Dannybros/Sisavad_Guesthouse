<?php
    include_once ("../config/dbconnect.php");

    $cust_ID = uniqid('c');
    $cust_name = $_POST['cust_name'];
    $cust_fname = $_POST['cust_fname'];
    $contact = $_POST['cust_contact'];
    $email = $_POST['cust_email'];
    $passport = $_POST['cust_id_passport'];
    $bd = $_POST['cust_bd'];

    $sql="INSERT INTO `customer`(`cust_id`, `cust_name`, `cust_firstname`, `cust_bd`, `contact`, `email`, `passport`) VALUES ('$cust_ID','$cust_name','$cust_fname', '$bd', '$contact', '$email', '$passport')";
    $result = mysqli_query($conn, $sql);
    
    if ($result){
        echo "success";
        exit();
    }else{
        echo mysqli_error($conn);
        exit();
    }


?>