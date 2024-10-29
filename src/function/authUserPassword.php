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

        if ($_SESSION['login_attempts'] >= 3) {
            return 'blocked';
        } else {
            return false;
        }
    }
}

echo $_POST['password'];
// Capture form data
$passwordHash = openssl_encrypt($_POST['password'], $ciphering, $encrypting_key, $option, $encrypting_iv);

// Connection to the database
$conn = getDatabaseConnection();

// Simple login verification
$someValue = "false";
$isLoginSuccessful = ($someValue === "true") ? true : false;



echo "</br> </br> Token: " . $_SESSION['userTokenPassVerification'] . "</br> </br>";
// Obter o token do usuário da sessão e a senha inserida no formulário
$user_token = $_SESSION['userTokenPassVerification'];

// Preparar a consulta SQL
$stmt = $conn->prepare("SELECT token, password FROM users WHERE token = ?");
$stmt->bind_param("s", $user_token);
$stmt->execute();
$stmt->bind_result($token, $passwordDB);
$stmt->fetch();
$stmt->close(); // Fechar o statement após o uso

if ($passwordDB === $passwordHash) {
    //login successful 
    $someValue = "true";
    $isLoginSuccessful = (bool)$someValue;
}


$result = checkLoginAttempts($isLoginSuccessful);

if ($result === true) {
    // Login successful
    //Get user token
    $_SESSION['userToken'] = $token; // Store the token in the session
    $_SESSION['userTokenPassVerification'] = null;

    header("Location: ../../public/dashboard.php");
    exit();
} elseif ($result === 'blocked') {
    header("Location: ../../public/blockedUser.php"); // Return to blocked page
    exit();
} elseif ($result === false) {
    $_SESSION['showMessage'] = true;
    header("Location: ../../public/passwordLogin.php");
    exit();
}
