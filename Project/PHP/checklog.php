<?php

session_start();

if (isset($_SESSION['islogged'])) {
    if ($_SESSION['islogged'] == !0) {
        header("location:../PHP/placeorder.php");
    }
}


if (isset($_POST['username']) && isset($_POST['pass'])) {

    $_SESSION['islogged'] = 0;
    $valid_user = 0;
    @$dp = new mysqli('localhost', 'root', '', 'orchid_store');
    if (mysqli_connect_errno()) {
        echo '<script>alert("Can not connect to database")</script> ';
        die();
    }
    $strQry = 'select * from site_users';
    $res = $dp->query($strQry);
    for ($i = 0; $i < $res->num_rows; $i++) {
        $row = $res->fetch_assoc();
        if ($_POST['username'] == $row['Name'] && sha1($_POST['pass']) == $row['Password']) {
            $_SESSION['islogged'] = $row['ID'];
            echo '<script> make_order()</script> ';
            header("location:../PHP/placeorder.php");
            $valid_user = 1;
        }

    }
    if ($valid_user == 0) {
        echo '<script>alert(" Your Username or Password is incorrect , Please try again") </script>';
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/loginsheet.css">

    <style>

        div.container{
            position:fixed;
            top: 200px;
            left: 750px;
        }


    </style>
</head>
<body>

<nav class="navbar navbar-expand fixed-top " style="background-color:#bf65bd ; text-align: center">


    <ul class="navbar-nav col-sm-6" style="align-content: center">
        <li class="nav-item col-sm-5">
            <a class="navbar-brand col-sm-4" href="../PHP/index.php" style="color:ghostwhite">
                <img src="../img/logoo2.png" class="" width="40px" height="40px">Orchid Store

            </a>
        </li>
        <li class="nav-item col-sm-5">
            <a class="nav-link " href="../PHP/products.php" style="color:ghostwhite">Orchid Products</a>
        </li>
        <li class="nav-item col-sm-6">
            <a class="nav-link" href="contact.php" style="color:ghostwhite">Contact Us </a>
        </li>
        <il class="nav-item col-sm-3">
            <a class="nav-link" href="../PHP/index.php#aboutUs" style="color:ghostwhite">About Us</a>
        </il>
        <li class="nav-item col-sm-4">
            <a class="nav-link" href="../PHP/login.php" style="color:ghostwhite">Log in</a>
        </li>
    </ul>


</nav>



<form method="post" action="checklog.php">
    <table width="100%" align="center">
        <tr>

            <td >
                <div class="container" align="left" style="color: #195d19; font-size: 20px" >
                    <b> Please login or create an account to complete your purchase ..</b>
                </div>

            </td>
            <td>

            </td>
        </tr>
        <tr>

            <td> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>

        </tr>
        <tr>
            <td width="60%"></td>
            <td><label for="username"><b> User Name</b> </label></td>
            <td><input type="text" id="username" name="username"></td>
        </tr>

        <tr>
            <td width="50%"></td>
            <td><label for="pass"> <b>Password</b></label></td>
            <td><input type="password" id="pass" name="pass"></td>
        </tr>

        <tr>
            <td width="50%"></td>
            <td></td>

            <td>
                <input type="submit" value="Sign in" style="color: #195d19; width: 30%;" >
            </td>

        </tr>
        <tr>
        <tr>
            <td><br> <br></td>
        </tr>
        <td width="50%"></td>
        <td></td>
        <!--        <td ><label for = "signup"><b>You don't have an acount?</b> </label> </td>-->
        <!--            <td ><input type="button" value="Sign Up" id="signup"  style="color: #195d19; width: 70%;"  > </td>-->
        <!--        <a href="../PHP/signup.php"><b>You don't have an acount?</b><button>Sign Up? </button></a>-->
        <td><b>You don't have an account? </b> <a href="../PHP/signup.php" style="color: #195d19">Sign up</a></td>

        </tr>
    </table>
</form>


</body>
</html>