<?php

session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['islogged'])) {

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
    if ($row['User_level'] == 'customer') {

        header("location:../PHP/index.php");

    }


} else  header("location:../PHP/index.php");


if (isset($_POST['add'])) {


    @$db = new mysqli('localhost', 'root', '', 'orchid_store');
    if (mysqli_connect_errno()) {
        echo '<script>alert("Can not connect to database")</script> ';
        die();
    }
    $name = $_POST['plantname'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];
    $desc = $_POST['desc'];
    $family = $_POST['family'];
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    if ($name == '' || $price == '' || $amount == '' || $desc == '' || $family == '' || $file == '')
        echo "<script> alert('Please fill all the information!');</script> ";
    else {
        $query = "insert into `products`(`image`,`Name`,`Price`,`Amount`,`Family`,`Description`) values ('" . $file . "', '" . $name . "', '" . $price . "', '" . $amount . "','" . $family . "','" . $desc . "') ";

        $result = $db->query($query);
        if ($result) {
            echo "<script>alert('Done');</script> ";

        } else {
            echo "<script> alert('Something wrong!');</script> ";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add product</title>

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

<form method="post" enctype="multipart/form-data" id="formp">
    <div class="container">
        <table class="table borderless">
            <tbody>
            <tr>
                <td class="label"> image:</td>
                <td><input type="file" name="image" id="image"style="border-radius: 10px" required></td>
            </tr>
            <tr>
                <td class="label"> name:</td>
                <td>
                    <input type="text" name="plantname" id="plantname" required>
                </td>
            </tr>
            <tr>
                <td class="label">Price:</td>
                <td><input type="text" name="price" id="price" required></td>
            </tr>
            <tr>
                <td class="label">Amount:</td>
                <td><input type="text" name="amount" id="amount" required></td>
            </tr>
            <tr>
                <td class="label">Family:</td>
                <td><input type="text" name="family" id="family" required></td>
            </tr>
            <tr>
                <td class="label">Description:</td>
                <td> <textarea style=";resize: none; outline: none; border-radius: 10px" rows="4" cols="40" name="desc" id="desc"
                               form="formp"
                               required></textarea></td>
            </tr>

            <tr>
                <td class="label" style="border-bottom: none"></td>
                <td style="border-bottom: none"><input type="submit" name="add" id="add" value="Add plant"></td>
            </tr>

            </tbody>
        </table>

    </div>

</form>
<script>
</script>
</body>
</html>
