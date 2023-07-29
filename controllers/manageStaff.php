<?php
    include_once ("../config/dbconnect.php");

    if(isset($_GET['save'])){

        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $ID_Card=$_POST['ID_Card'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $position=$_POST['position'];
        $salary=$_POST['salary'];
    
        $sql="INSERT INTO `employee`(`emp_Name`, `gender`, `emp_ID_Card`, `phone`, `email`, `position`, `salary`) VALUES ('$name', '$gender', '$ID_Card','$phone','$email','$position','$salary')";

    }else if(isset($_GET['edit'])){

        $id = $_POST['id'];
        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $ID_Card=$_POST['ID_Card'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $position=$_POST['position'];
        $salary=$_POST['salary'];
    
        $sql="UPDATE `employee` SET `emp_Name`='$name',`gender`='$gender',`emp_ID_Card`='$ID_Card',`phone`='$phone',`email`='$email',`position`='$position',`salary`='$salary' WHERE `emp_ID`='$id'";

    }else if (isset($_GET['del'])){
        
        $id = $_POST['id'];

        $sql="DELETE FROM `employee` WHERE `emp_ID`='$id'";
    }
    
    $result=mysqli_query($conn, $sql);

    if ($result){
        echo "success";
        exit();
    }else{
        echo mysqli_error($conn);
        exit();
    }
?>