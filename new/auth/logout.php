<?php
    session_start();
    include("../connection.php");
    // Update status to 'Inactive' 
    $update_status_stmt = $conn->prepare("UPDATE `users` SET status = 'Inactive' WHERE username = ?"); 
    $update_status_stmt->bind_param("s", $_SESSION['username']); 
    $update_status_stmt->execute();
    session_destroy();
    header('location: Login3d.php');
?>