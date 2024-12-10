<?php
include("../connection.php");
session_start();

// Debugging: Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_user'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $sql = $conn->prepare("SELECT * FROM `artisans` WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result_artisans = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password_db = $row['password'];

        // Define the same salt used during hashing
        $salt = "<{adda123}>";

        // Combine the entered password with the salt
        $salted_entered_password = $salt . $pass;

        // Hash the salted entered password using SHA-256
        $hashed_entered_password = hash('sha256', $salted_entered_password);

        // Verify password using password_verify
        if ($password_db == $hashed_entered_password) {
            $_SESSION['username'] = $username;
            // Regenerate session ID to prevent session fixation
            session_regenerate_id();

            // Update status to 'Active' 
            $update_status_stmt = $conn->prepare("UPDATE `users` SET status = 'Active' WHERE username = ?"); 
            $update_status_stmt->bind_param("s", $username); 
            $update_status_stmt->execute();

            if ($result_artisans->num_rows > 0) {
                $_SESSION['artisan']=1;
                echo "<script>alert(".$_SESSION['artisan'].");</script>";
            } else {
                $_SESSION['artisan']=0;
                echo "<script>alert(".$_SESSION['artisan'].");</script>";
            }

            echo "<script>window.open('../index.php?user=$username','_self')</script>";
            header("Location: ../index.php?user=$username");
            exit;
        } else {
            session_destroy();
            echo "<script>alert('Invalid password!');</script>";
            header("Location: login3d.php");
            exit;
        }
    } else {
        session_destroy();
        echo "<script>alert('Invalid Username or Password!');</script>";
        header("Location: login3d.php");
        exit;
    }
} else {
    // Debugging: Check if condition is false
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Form method is not POST";
    } elseif (!isset($_POST['login_user'])) {
        echo "login_user is not set";
    }
    
    //header("Location: login3d.php");
    exit;
}
$conn -> close();
?>
