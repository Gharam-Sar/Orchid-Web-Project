<?php

session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
@$dp = new mysqli('localhost', 'root', '', 'orchid_store');
if (mysqli_connect_errno()) {
    echo '<script>alert("Can not connect to database")</script> ';
    die();
}
$User = '';
if (isset($_SESSION['islogged'])) {

    $id = $_SESSION['islogged'];
    $strQry = "select * from site_users where ID = '$id'";
    $res = $dp->query($strQry);
    $row = $res->fetch_assoc();
    $User = $row['Name'];
    if ($row['User_level'] == 'customer') {

        header("location:../PHP/index.php");

    }
} else  header("location:../PHP/index.php");


if (isset($_POST['update'])) {

    $id = $_POST['order'];
    $status = $_POST['status'];

    $Qry = "UPDATE orders SET Status = '$status' where ID = '$id' ";
    $res = $dp->query($Qry);

    if (!$res) {

        echo '<script>alert("Something wrong happened");</script> ';

    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>

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
    <link rel="stylesheet" href="../Css/orderssheet.css">
    <script src="../JS/products.js"></script>

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
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Buyer name</th>
            <th>Buyer ID</th>
            <th>Product name</th>
            <th>Product ID</th>
            <th>Price</th>
            <th>Buyer Phone</th>
            <th>Buyer Address</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $strQry = 'select * from orders';
        $res = $dp->query($strQry);
        for ($i = 0; $i < $res->num_rows; $i++) {
            $row = $res->fetch_assoc();

            ?>
            <tr>

                <td><?php echo $row["ID"]; ?> </td>
                <td><?php echo $row["Date"]; ?> </td>
                <td><?php echo $row["Uname"]; ?> </td>
                <td><?php echo $row["U_ID"]; ?> </td>
                <td><?php echo $row["Pname"]; ?> </td>
                <td><?php echo $row["P_ID"]; ?> </td>
                <td><?php echo $row["Price"]; ?> </td>
                <td>0<?php echo $row["Phone"]; ?></td>
                <td><?php echo $row["Address"]; ?> </td>
                <td><?php echo $row["Status"]; ?> </td>
            </tr>

            <?php
        }
        ?>
        <tr>
            <form method="post" action="orders.php">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" name="order" placeholder="No."></td>
                <td><input type="text" name="status" placeholder="status" style="width :100px"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </form>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>