<?php
session_start();
require_once '../cfg/db.php';
include '../cfg/encryptor.php';

// Manage login attempts
function checkLoginAttempts($isLoginSuccessful)
{
    if ($isLoginSuccessful === true) {
        unset($_SESSION['login_attempts']);
        return true;
    } else {
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 1;
        } else {
            $_SESSION['login_attempts']++;
        }

        if ($_SESSION['login_attempts'] >= 10) {
            return 'blocked';
        } else {
            return false;
        }
    }
}

// Capture form data
$username = $_POST['username'];

// Connection to the database
$conn = getDatabaseConnection();

// Simple login verification
$someValue = "false";
$isLoginSuccessful = ($someValue === "true") ? true : false;

$stmt = $conn->prepare("SELECT token FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($row['token'] != null) {
        //login successful 
        $someValue = "true";
        $isLoginSuccessful = (bool)$someValue;

        $token = $row['token'];
    }
}



$result = checkLoginAttempts($isLoginSuccessful);

if ($result === true) {
    // Login successful
    //Get user token
    $_SESSION['userTokenPassVerification'] = $token; // Store the username in the session

    header("Location: ../../public/passwordLogin.php");
    exit();
} elseif ($result === 'blocked') {
    header("Location: ../../public/blocked.php"); // Return to blocked page
    exit();
} elseif ($result === false) {
    $_SESSION['showMessage'] = true;
    header("Location: ../../public/index.php");
    exit();
}