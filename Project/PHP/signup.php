<?php


session_start();
if (isset($_SESSION['islogged'])) {
    if ($_SESSION['islogged'] == !0) {
        header("location:../PHP/index.php");
    }
}


if (isset($_POST['username']) && isset($_POST['pass'])) {

    $_SESSION['issigned'] = 0;
    $valid_user = 0;
    @$dp = new mysqli('localhost', 'root', '', 'orchid_store');
    if (mysqli_connect_errno()) {
        echo '<script>alert("Can not connect to database")</script> ';

        die();
    }
    $name = $_POST['username'];
    $pass = sha1($_POST['pass']);
    $address = $_POST['address'];
    $level = 'customer';
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    if (!$email) {
        $email = NULL;
    }
    $exist_user = 0;
    $strQry = 'select * from site_users';
    $result = $dp->query($strQry);
    $nextID= $result->num_rows;
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        if ($name == $row['Name']) {
            $exist_user = 1;
            echo '<script> alert("There is an account with same name")</script> ';
            header("location:signup.php");

        }

    }
    if ($exist_user == 0) {
        $query = "insert into `site_users`(`Name`,`Password`,`User_level`,`Address`,`Phone`,`Email`) values ('" . $name . "', '" . $pass . "', '" . $level . "', '" . $address . "','" . $phone . "','" . $email . "') ";
        $res = $dp->query($query);
        if ($res) {
            $_SESSION['islogged'] = $nextID+1;
            header("location:signed.php");
        }


        if ($valid_user == 0) {
            echo '<script>alert("Something wrong happened")</script> ';

        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>

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

    <link rel="stylesheet" href="../Css/procuctsheet.css">
    <link rel="stylesheet" href="../Css/profilesheet.css">

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
<form method="post" action="signup.php">
    <div class="container">
        <table class="table borderless">

            <tbody>
            <tr>
                <td class="label"><label for="username"><b> User Name</b> </label></td>
                <td><input type="text" id="username" name="username"  required></td>
            </tr>
            <tr>
                <td class="label"><label for="pass"> <b>Password</b></label></td>
                <td ><input type="password" id="pass" name="pass" required></td>
            </tr>
            <tr>
                <td class="label"><label for="address"> <b>Address</b></label></td>
                <td><input type="text" id="address" name="address" required></td>
            </tr>
            <tr>
                <td class="label"><label for="phone"> <b>Phone</b></label></td>
                <td><input type="text" id="phone" name="phone" pattern="[0][5][0-9]{8}"
                           required placeholder="05xxxxxxxx"></td>
            </tr>
            <tr>
                <td class="label"><label for="email"> <b>Email</b></label></td>
                <td><input type="email" id="email" name="email" ></td>
            </tr>

            <tr>
                <td class="label" style="border-bottom: none"></td>
                <td style="border-bottom: none"><input type="submit" value="Sign Up"></td>
            </tr>

            </tbody>
        </table>

    </div>

</form>


</body>
</html>
