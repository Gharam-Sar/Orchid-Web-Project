<?php

session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];

?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
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
    <title>Orchid</title>
    <link type="text/css" rel="stylesheet" href="../Css/stylesheet.css">
</head>
<body>

<?php
if (isset($_SESSION['islogged'])) {
    if ($_SESSION['islogged'] == 0) {
        ?>
        <nav class="navbar navbar-expand fixed-top " style="background-color:#bf65bd ; text-align: center">
            <ul class="navbar-nav col-sm-6" style="align-content: center">
                <li class="nav-item col-sm-5">
                    <a class="navbar-brand col-sm-4" href="../PHP/index.php" style="color:ghostwhite">
                        <img src="../img/logoo2.png" width="40px" height="40px">Orchid Store

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
        <?php
    }
    else
    {@$dp = new mysqli('localhost', 'root', '', 'orchid_store');
        if (mysqli_connect_errno()) {
            echo '<script>alert("Can not connect to database")</script> ';
            die();
        }
        $strQry = "select * from site_users where ID = ".$_SESSION['islogged']." ";
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
    } }
else {
    ?>
    <nav class="navbar navbar-expand fixed-top " style="background-color:#bf65bd ; text-align: center">
        <ul class="navbar-nav col-sm-6" style="align-content: center">
            <li class="nav-item col-sm-5">
                <a class="navbar-brand col-sm-4" href="../PHP/index.php" style="color:ghostwhite">
                    <img src="../img/logoo2.png" width="40px" height="40px">Orchid Store

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

    <?php
}
?>


<br>
<br>
<br>
<div class="container" style="margin-top: 100px; background-attachment: fixed">
    <table>
        <tr>
            <td id="#1" style="margin-right: 1000px; position: relative">
                <div style=" width: 500px; height: 500px; margin-right: 0px; position: relative">

                <pre>
             <h3 style="text-shadow: 2px 2px 4px #000;">

   <img src="../img/media.png" style="width: 100px; height: 100px">  Keep up with us
         on Social Media </h3>


     <a id="face" href="https://www.facebook.com/plantsonlinee" target="_blank"> <img src="../img/facebook.png"
                                                                                      style="width: 100px;height: 100px"></a>                      <a
                        href="https://www.instagram.com/onlineorchid/?igshid=78lsf8vv1rjc&fbclid=IwAR28AujnqK8TKf3VTYDdZ3nKMfwlEgyWwO9XlzLwQVaqPKs7IUzs54SVLaw"
                        target="_blank"> <img src="../img/insta.png" style="width: 150px;height: 150px"></a>
      <b style="text-shadow: 1px 1px 4px #000;">Orchid-أوركيد                 OnlineOrchid</b>
                </pre>
                </div>

            </td>
            <td>
                <div align="left" id="demo" class="carousel slide container" data-ride="carousel"
                     style="width: 500px; height: 500px; position:relative;margin-left:200px">
                    <!-- Indicators -->
                    <ul class="carousel-indicators " style="  width: 30%; align-items: start">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                        <li data-target="#demo" data-slide-to="3"></li>
                        <li data-target="#demo" data-slide-to="4"></li>
                        <li data-target="#demo" data-slide-to="5"></li>
                    </ul>
                    <div class="carousel-inner " style="align-content: center">
                        <div class="carousel-item active">
                            <img src="../img/slides/s10.jpg" style="width: 500px; height: 500px" alt="pic">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/Trees/Dieffenbachia.jpg" style="width: 500px; height: 500px" alt="pic">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/Bulbous/Tulip.jpg" style="width: 500px; height: 500px" alt="pic">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/Trees/Peace%20lily.jpg" style="width: 500px; height: 500px" alt="pic">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/Succulents/aloevera.jpg" style="width: 500px; height: 500px" alt="pic">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/slides/s6.jpg" style="width: 500px; height: 500px" alt="pic">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>

                </div>

            </td>

        </tr>

    </table>


</div>


<br>
<br>

<div class="about">
<pre id="aboutUs">

                            We are a small business owners who want to brighten your house, office and garden
                                with beautiful plants and flowers , we travel from place to place to collect
                                and deliver the special items you deserve.
                                                                          Hadeel Damen <img src="../img/pen.png" style="width: 150px;height: 150px">

</pre>

</div>
</body>
</html>