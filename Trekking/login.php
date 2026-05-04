<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli("localhost","root","","trekking");

if($conn->connect_error){
    die("Connection Failed");
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");

if(!$stmt){
    die($conn->error);
}

$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $user = $result->fetch_assoc();

    /* VERIFY HASHED PASSWORD */
    if(password_verify($password,$user['password'])){

        $_SESSION['user_id']=$user['id'];
        $_SESSION['username']=$user['username'];
        $_SESSION['email']=$user['email'];

        header("Location: index.php");
        exit();

    }else{
        echo "<script>alert('Wrong Password');window.history.back();</script>";
    }

}else{
    echo "<script>alert('User not found');window.history.back();</script>";
}
?>
