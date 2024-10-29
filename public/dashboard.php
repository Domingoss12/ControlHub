<?php
session_start();

echo "Login feito com o token: ". $_SESSION['userToken'];
?>