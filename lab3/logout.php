<?php
session_start();

if (isset($_SESSION['login']) and $_SESSION['login']==true) {
    $_SESSION = array();
    session_destroy();
}
header("Location: login.php");