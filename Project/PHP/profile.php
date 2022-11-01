<?php

session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
@$dp = new mysqli('localhost', 'root', '', 'orchid_store');
if (mysqli_connect_errno()) {

    echo '<script> alert("Can not connect to database")</script> ';
    die();
}

if (!isset($_SESSION['islogged'])) {
    header('location:index.php');
}
$strQry = "select * from site_users where ID = " . $_SESSION['islogged'] . " ";
$res = $dp->query($strQry);
$row = $res->fetch_assoc();
$User = $row['Name'];
$id = $_SESSION['islogged'];

if (isset($_POST['delete'])) {
 $idd = $_POST['de_id'];
    $strQry = "delete from site_users where ID ='$idd' ";
    $res = $dp->query($strQry);
    if ($res) {
        echo '<script> alert("Deleted successfully");</script>';
        session_destroy();
        header('location:index.php');
    }
    else echo '<script> alert("Something wrong happened");</script>';
    unset($_POST['delete']);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $User; ?></title>

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

    <script type="text/javascript" src="../JS/profile.js.js"></script>
    <script>
        function check() {

            var first = document.getElementById('new').value;
            var second = document.getElementById('new2').value;

            var span = document.getElementById('result');
            if (first === second) {
                span.style.color = 'white';
                span.innerHTML = 'Passwords match';
            } else {
                span.style.color = 'black';
                span.innerHTML = 'Passwords do not match';
            }
        }



        function save() {

            var old = document.getElementById('old').value;
            var first = document.getElementById('new').value;
            var second = document.getElementById('new2').value;
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var address = document.getElementById('address').value;

            if (old == '') {

                old = null;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "whatever.php?old=" + old + "&first=" + first + "&second=" + second + "&username=" + username + "&email=" + email + "&phone=" + phone+"&address="+address, false);
            xmlhttp.send();

            document.body.innerHTML = xmlhttp.responseText;
        }


    </script>
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
        <table class="table borderless">

            <tbody>
            <tr>
                <td class="label"> Username:</td>
                <td><input class="name" name="username" id="username" type="text" value="<?php echo $User; ?>"></td>
            </tr>
            <tr>
                <td class="label"> Password:<br><br><br></td>
                <td>
                    <input name="old" id="old" type="password" placeholder="Current..." autocomplete="off" value="">
                    <input name="new" id="new" type="password" placeholder="New..." autocomplete="off" value="">
                    <input name="new2" id="new2" type="password" placeholder="Re-type new..." onkeyup="check();" value=""
                           autocomplete="off"
                           onkeydown=" document.getElementById('result').innerText=''; ">
                    <span id="result"></span>
                </td>
            </tr>
            <tr>
                <td class="label ">Address:</td>
                <td><input class="address" name="address" id="address" type="text" value="<?php echo $row['Address']; ?>"></td>
            </tr>
            <tr>
                <td class="label">Phone:</td>
                <td><input class="phone" name="phone" id="phone" type="text" value="0<?php echo $row['Phone']; ?>"></td>
            </tr>
            <tr>
                <td class="label">E-mail:</td>
                <td><input class="email" name="email" id="email" type="text" value="<?php echo $row['Email']; ?>"></td>
            </tr>

            <tr>

                <td class="label" style="border-bottom: none"></td> <form method="post" action="profile.php">
                <input type="text" name="de_id" hidden value="<?php echo $row['ID']; ?>">
                <td style="border-bottom: none " ><input style="width: 40%" type="submit" name="delete" value="Delete"> </form>
                    <button name="save" onclick="save();" style="width: 40%"> Save</button>
                <span></span>
                </td>

            </tr>

            </tbody>
        </table>

    </div>

<br><br><br>
</body>
</html>

