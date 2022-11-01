<?php
session_start();

if (isset($_SESSION['islogged'])) {
    if ($_SESSION['islogged'] == 0) {
        header("location:login.php");
    }
    header('Location: ' . $_SESSION['url']);
} else {
    header("location:login.php");
}
?>

