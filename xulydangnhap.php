<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['login'])) {

    // Create a connection
    $conn = mysqli_connect('localhost', 'root', '', 'web_database');
    
    // Check connection
    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Escape user input for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Prepare the SQL query
    $query = "SELECT * FROM kh WHERE IDKH='$username' AND MK='$password'";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        echo json_encode($_SESSION['username']);
        header('Location: index.php');
        exit(); // Ensure no further code is executed        
    } else {
        echo "<script type='text/javascript'>alert('Tài khoản hoặc mật khẩu chưa chính xác.'); window.location.href='dangnhap.html';</script>";
    }
}

