<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Info</title>
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
    <!--   <link rel="stylesheet" href="../Css/profilesheet.css">-->
    <style>
        body {
            background: rgb(255, 230, 255);
            background-image: url("../img/ssss.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100% 100%;
            background-attachment: fixed;


        }

        div.container {


            position: center;
            position: absolute;
            top: 15%;
            left: 25%;
            right: 25%;
            margin-bottom: 100px;
            background-color: #bf65bd;
            width: 35%;
            align-content: center;
            -webkit-box-shadow: 0px 0px 20px grey;
            box-shadow: 0px 0px 20px grey;
            border-radius: 10px;
        }

        table {
            position: relative;
            align-content: center;
        }

        .borderless td {

            padding: 20px;
            color: white;
            border: none;
            border-bottom: 0.5px solid white;

        }

        .borderless td input {
            border-radius: 10px;

            margin: 5px;
        }

        .borderless td.label {
            color: white;
            font-size: 20px;
            background-color: #bf65bd;

        }

        td.label {

            width: 70%;


        }

        a {
            color: black;
        }

        a:hover {
            color: white;


        }
    </style>
</head>
<body>

<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['islogged'])) {
    if ($_SESSION['islogged'] == 0) {
        ?>
        <nav class="navbar navbar-expand fixed-top " style="background-color:#bf65bd ; text-align: center">
            <ul class="navbar-nav col-sm-6" style="align-content: center">
                <li class="nav-item col-sm-5">
                    <a class="navbar-brand col-sm-4" href="index.php" style="color:ghostwhite">
                        <img src="../img/logoo2.png" width="40px" height="40px">Orchid Store

                    </a>
                </li>
                <li class="nav-item col-sm-5">
                    <a class="nav-link " href="products.php" style="color:ghostwhite">Orchid Products</a>
                </li>
                <li class="nav-item col-sm-6">
                    <a class="nav-link" href="contact.php" style="color:ghostwhite">Contact Us </a>
                </li>
                <il class="nav-item col-sm-3">
                    <a class="nav-link" href="index.php#aboutUs" style="color:ghostwhite">About Us</a>
                </il>
                <li class="nav-item col-sm-4">
                    <a class="nav-link" href="login.php" style="color:ghostwhite">Log in</a>
                </li>
            </ul>
        </nav>
        <?php
    } else {
        @$dp = new mysqli('localhost', 'root', '', 'orchid_store');
        if (mysqli_connect_errno()) {
            echo '<script>alert("Can not connect to database")</script> ';
            die();
        }

        $id = $_SESSION['islogged'];
        $strQry = "select * from site_users where ID = '$id'";
        $res = $dp->query($strQry);
        $row = $res->fetch_assoc();
        $User = $row['Name'];


        ?>
        <nav class="navbar navbar-expand fixed-top " style="background-color:#bf65bd ; text-align: center">


            <ul class="navbar-nav col-sm-7" style="align-content: center">
                <li class="nav-item col-sm-4">
                    <a class="navbar-brand col-sm-4" href="index.php" style="color:ghostwhite">
                        <img src="../img/logoo2.png" class="" width="40px" height="40px">Orchid Store

                    </a>
                </li>
                <li class="nav-item col-sm-4">
                    <a class="nav-link " href="products.php" style="color:ghostwhite">Orchid Products</a>
                </li>
                <li class="nav-item col-sm-4">
                    <a class="nav-link" href="contact.php" style="color:ghostwhite">Contact Us </a>
                </li>
                <il class="nav-item col-sm-3">
                    <a class="nav-link" href="index.php#aboutUs" style="color:ghostwhite">About Us</a>
                </il>

                <li class="nav-item col-sm-3">

                    <a class="nav-link" href="../PHP/profile.php" style="color:ghostwhite"><?php echo $User; ?></a>
                </li>
                <li class="nav-item col-sm-3">
                    <a class="nav-link" href="../PHP/signout.php" style="color:ghostwhite">Sign Out</a>

                </li>
            </ul>


        </nav>

        <?php
    }
} else {
    ?>
    <nav class="navbar navbar-expand fixed-top " style="background-color:#bf65bd ; text-align: center">
        <ul class="navbar-nav col-sm-6" style="align-content: center">
            <li class="nav-item col-sm-5">
                <a class="navbar-brand col-sm-4" href="index.php" style="color:ghostwhite">
                    <img src="../img/logoo2.png" width="40px" height="40px">Orchid Store

                </a>
            </li>
            <li class="nav-item col-sm-5">
                <a class="nav-link " href="products.php" style="color:ghostwhite">Orchid Products</a>
            </li>
            <li class="nav-item col-sm-6">
                <a class="nav-link" href="contact.php" style="color:ghostwhite">Contact Us </a>
            </li>
            <il class="nav-item col-sm-3">
                <a class="nav-link" href="index.php#aboutUs" style="color:ghostwhite">About Us</a>
            </il>
            <li class="nav-item col-sm-4">
                <a class="nav-link" href="login.php" style="color:ghostwhite">Log in</a>
            </li>
        </ul>


    </nav>

    <?php
}

?>

<div class="container" style="height: 50%; top: 40%">
    <table class="table borderless" style="height: 50%;">

        <tbody>
        <tr>
            <td class="label">Phone:</td>
            <td style="color: black"><b>+970-598828113</b></td>
        </tr>
        <tr>
            <td class="label">E-mail:</td>
            <td>
                <a href="mailto: online_flowers@hotmail.com"><b> online_flowers@hotmail.com</b></a>
            </td>
        </tr>

        <tr>
            <td class="label">Facebook:</td>
            <td><a href="https://www.facebook.com/plantsonlinee" target="_blank"><b>
                        Orchid-أوركيد </b></a></td>
        </tr>

        <tr>
            <td class="label">Instagram:</td>
            <td>
                <a href="https://www.instagram.com/onlineorchid/?igshid=78lsf8vv1rjc&fbclid=IwAR28AujnqK8TKf3VTYDdZ3nKMfwlEgyWwO9XlzLwQVaqPKs7IUzs54SVLaw"
                   target="_blank"><b> OnlineOrchid </b></a></td>
        </tr>


        </tbody>
    </table>
</div>


</body>
</html>