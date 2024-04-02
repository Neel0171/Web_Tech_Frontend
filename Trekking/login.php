<?php
$email=$_POST['email'];
$password=$_POST['password'];


$con =new mysqli("localhost","root","","trekk");
if ($con->connect_error) {
    die("Failed to connect". $con->connect_error);
}else{
            $stmt=$con->prepare("select * from signup where email =?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
                $stmt_result= $stmt->get_result();
                if ($stmt_result->num_rows > 0) {
                    $data = $stmt_result->fetch_assoc();
                    // $Name = $data['Name'];
                    // Checking password
                    if ($data['password'] === $password) { // Change $password to $Password
                        // Redirecting to USCI.html upon successful login
                        $_SESSION['Email'] = $email;
                        // $_SESSION["Name"] = $Name;
                        echo "<h2>Login Successful</h2>";
                        echo '<script>window.location.href = "home.html";</script>';
                        exit();
                    } else {
                        // Password doesn't match
                        echo "<h2>Invalid Username or Password</h2>";
                       echo '<script>window.location.href = "login.html";</script>';
                        exit();
                    }
                    
                } else {
                    // No user found with the provided email
                    echo "<h2>Invalid Username or Password</h2>";
                    echo '<script>window.location.href = "login.html";/script>';
                    exit();
                }
            }
            ?>