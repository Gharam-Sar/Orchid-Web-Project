<?php

session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
@$dp = new mysqli('localhost', 'root', '', 'orchid_store');
if (mysqli_connect_errno()) {
    echo '<script>alert("Can not connect to database")</script> ';
    die();
}
if (isset($_SESSION['ordered']) && $_SESSION['ordered'] == 1) {
    echo "<script>alert('Order has been placed \\n Delivery will take up to 7 business days.');</script> ";
    $_SESSION['ordered'] = 0;
}
if (isset($_POST['edit'])) {
    $imgid = intval($_POST['imgid']);

    $name = $dp->real_escape_string($_POST['name']);
    $pricearr = explode(' ', $_POST['price']);
    $price = ($pricearr[0]);
    $desc = $dp->real_escape_string($_POST['desc']);
    $amount = $dp->real_escape_string($_POST['amount']);
    $family = $dp->real_escape_string($_POST['family']);
    $strQry = "UPDATE products SET Name = '$name' , Family = '$family', Amount = $amount, Price = $price , Description ='$desc' WHERE ID ='$imgid' ";
    $res = $dp->query($strQry);

    if ($res)
        echo '<script> alert("Updated successfully");</script>';

    else echo '<script> alert("Something wrong happened");</script>';
    unset($_POST['edit']);
}
if (isset($_POST['delete'])){

    $imgid = intval($_POST['imgid']);
    $strQry = "delete  from products where ID ='$imgid' ";

    $res = $dp->query($strQry);

    if ($res)
        echo '<script> alert("Deleted successfully");</script>';

    else echo '<script> alert("Something wrong happened");</script>';
    unset($_POST['delete']);
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>

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
    <script src="../JS/products.js"></script>

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
        {
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


<div class="container" id="#container">
    <?php
    $strQry = 'select * from products ORDER BY ID asc ';
    $res = $dp->query($strQry);
    if (isset($_SESSION['islogged'])) {
        $id = $_SESSION['islogged'];
        $Qry = "select * from site_users where ID = '$id'";
        $user = $dp->query($Qry);
        $r = $user->fetch_assoc();
        if ($r['User_level'] == 'manager') {
            ?>

            <div id="#edit">
                <form method="post" action="addproducts.php" style="padding-left: 100px">
                    <input class="button" type="submit" value="Add product">
                </form>
                <form method="post" action="orders.php" style="padding-left: 100px">
                    <input class="button" type="submit" value="Orders">
                </form>
                <form method="post" action="statics.php" style="padding-left: 100px">
                    <input class="button" type="submit" value="Statics">
                </form>
            </div>

            <?php
        }

    }


    ?>
    <form id="myform" method="GET">
        <div class="row" id="top">
            <?php
            for ($i = 0; $i < $res->num_rows; $i++) {
                $row = $res->fetch_assoc();
                ?>
                <div class="card text-center">
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"onclick=' ?>
                    show(this.id);<?php echo 'name = "images" id=' . $row['ID'] . '>' ?>
                    <h5 style="padding: 5px"> <?php echo $row["Name"]; ?>  </h5>
                </div>
                <?php
            }
            $dp->close();
            ?>

        </div>
    </form>
</div>

<div class="overlay" id="#p1">

</div>

</body>
</html>