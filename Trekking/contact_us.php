<?php
    $db_hostname="Localhost";
    $db_username="root";
    $db_password="";
    $db_name="trekk";

    $conn=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
    if(!$conn)
    {
        echo"Connection Failed:",mysqli_connect_error();
        exit;
    }

    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $subject=$_POST['subject'];
    

    $sql="Insert into contact(Name,Email,Phone,Subject) values ('$name','$email','$phone','$subject')";
    $result=mysqli_query($conn,$sql);
    if(!$result)
    {
        echo "error: ",mysqli_error($conn);
        exit;
    }
    echo "We will contact you soon";
    mysqli_close($conn);
 
?>
