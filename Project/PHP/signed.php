<?php
session_start();
if (isset($_SESSION['islogged'])) {
    if ($_SESSION['islogged'] == 0) {
        header("location:signup.php");
    }
    header('Location: ' . $_SESSION['url']);
} else {
    header("location:signup.php");
}
?>

