<?php

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if($password !== $confirm_password){
    die("Passwords do not match");
}

$conn = new mysqli("localhost","root","","trekking");

if($conn->connect_error){
    die("Connection Failed");
}

/* HASH PASSWORD */
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
"INSERT INTO users(username,email,password) VALUES (?,?,?)"
);

$stmt->bind_param("sss",$username,$email,$hashed_password);

$stmt->execute();

header("Location: login.html");
exit();
?>
