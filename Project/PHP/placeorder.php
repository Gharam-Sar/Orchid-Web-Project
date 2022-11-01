<?php


session_start();

if (!isset($_SESSION['islogged'])) {

    header("location:../PHP/products.php");
}
$_SESSION['url'] = $_SERVER['REQUEST_URI'];

$id = $_SESSION['imgid'];///
$uid = $_SESSION['islogged'];//

@$db = new mysqli('localhost', 'root', '', 'orchid_store');
if (mysqli_connect_errno()) {
    echo '<script>alert("Can not connect to database")</script> ';
    die();
}
$strQry = "select * from products where ID = '$id'";
$res = $db->query($strQry);
$row = $res->fetch_assoc();

$Qry = "select * from site_users where ID = '$uid'";
$ures = $db->query($Qry);
$urow = $ures->fetch_assoc();
$User = $urow['Name'];
$date = date_create();
$date = date_format($date, "Y/m/d");
$price = $row['Price'];
if (isset($_POST['placeorder'])) {

    $phone = $urow['Phone'];
    $address = $urow['Address'];
    $usname = $urow['Name'];
    $proname = $row['Name'];
    $status = 'on its way';

    $orderqry = "insert into `orders`(`Date`,`U_ID`,`P_ID`,`Uname`,`Pname`,`Price`,`Status`,`Phone`,`Address`) values ('" . $date . "', '" . $uid . "', '" . $id . "', '" . $usname . "','" . $proname . "','" . $price . "','" . $status . "','" . $phone . "','" . $address . "') ";
    $orderres = $db->query($orderqry);

    if ($orderres) {

        $_SESSION['ordered'] = 1;
        $amount = $row['Amount'] - 1;
        $upQry = "UPDATE products SET Amount = '$amount'  WHERE ID ='$id' ";
        $db->query($upQry);
        header("location:products.php");

    } else {
        echo "<script> alert('Something wrong happened!');</script> ";
    }
}
?>


<!DOCTYPE HTML >

<html>
<head>
    <meta charset="UTF-8">
    <title>Order</title>

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
    <link rel="stylesheet" href="../Css/ordersheet.css">
    <style type="text/css">


    </style>

</head>
<body>

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


<div class="container">
    <div class="row">
        <?php echo '<img id="#im" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '">' ?>
    </div>
    <div class="row">
        <table id="#img">

            <tr>
                <td>
                    Name:
                </td>

            </tr>
            <tr>
                <td>
                    Price:

                </td>
            </tr>
            <tr>
                <td>
                    Family:

                </td>
            </tr>
            <tr>
                <td>
                    Description:
                </td>

            </tr>
        </table>
        <table id="#img2">

            <tr>
                <td>
                    <?php echo $row['Name']; ?>
                </td>

            </tr>
            <tr>
                <td>
                    <?php echo $row['Price']; ?>
                </td>

            </tr>

            <tr>
                <td>
                    <?php
                    echo $row['Family'] . str_repeat('&nbsp;', 5);

                    ?>

                </td>

            </tr>
            <tr>
                <td>
                    <?php echo $row['Description']; ?>
                </td>
            </tr>

        </table>
        <?php
        if ($row['Amount'] == 0) {
            echo '<span style="position: relative; top: 550px;left: 10px">This product is currently out of stock&#128542;<br> Come back after few days</span>';

        }
        ?>
    </div>
</div>
<div>
    <form action="placeorder.php" method="post">
        <?php if ($row['Amount'] == 0)
            echo ' <input type="submit" name="placeorder" value="Place order" disabled>';
        else {
            echo '<input type="submit" name="placeorder" value="Place order" style="box-shadow: 0 0 0">';
        } ?>
    </form>

    <span>Payment at delivery</span>
    <br><br <br><br <br><br <br><br <br><br <br><br>
</div>
</body>
</html>