<?php
?>
<?php
?>
<?php
if (isset($_POST['username'])&&isset($_POST['pass']))
{
    session_start();
    $_SESSION['issigned']=0;
    $valid_user=0;
    @$dp=new mysqli('localhost', 'root','','orchid_store');
    if(mysqli_connect_errno())
    {
        echo 'Can not connect to database';
        die();
    }
    $name=$_POST['username'];
    $pass=$_POST['pass'];
    $address=$_POST['address'];
    $level=customer;
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    if (!$email)
    {
        $email=NULL;
    }
    if (!$name || !$pass || !$address || !$phone) {
        echo "You have not entered all the required details.<br />"
            ."Please go back and try again.";
        exit; }
    $strQry = "insert into site_users values('".$name."', '".$pass."', '".$level."', '".$address."','".$phone."','".$email."')";
    $res = $dp ->query($strQry);


    if ($res)
    {
        $_SESSION['issigned']=1;
        header("location:signed.php");
    }


    if ($valid_user==0)
    {
        echo ' your username or password is incorrect , please try again ';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/signupsheet.css">

</head>
<body>


<nav class="navbar navbar-expand fixed-top " style="background-color:#bf65bd ; text-align: center" >


    <ul class="navbar-nav col-sm-6" style="align-content: center">
        <li class="nav-item col-sm-5">
            <a class="navbar-brand col-sm-4" href="../html/index.html"style="color:ghostwhite" >
                <img src="../img/logoo2.png" class="" width="40px" height="40px">Orchid Store

            </a>
        </li>
        <li class="nav-item col-sm-5">
            <a class="nav-link " href="../PHP/products.php" style="color:ghostwhite" >Orchid Products</a>
        </li>
        <li class="nav-item col-sm-6">
            <a class="nav-link" href="contact.php" style="color:ghostwhite" >Contact Us </a>
        </li>
        <il class="nav-item col-sm-3">
            <a class="nav-link" href="../html/index.html#aboutUs" style="color:ghostwhite">About Us</a>
        </il>
        <li class="nav-item col-sm-4">
            <a class="nav-link" href="../PHP/login.php" style="color:ghostwhite" >Sign in</a>
        </li>
    </ul>


</nav>
<form method="post" action="editprof.php">
    <table width="100%" align="center">

        <tr ><td>  <br> <br> <br> <br> <br> <br> <br>  </td></tr>
        <tr>
            <td width="30%"> </td>
            <td ><label for = "username"><b> User Name</b> </label> </td>
            <td ><input type="text" id="username" name="username" style="color: #195d19; width: 30%;" > </td>
        </tr>
        <tr> <td> <br> </td></tr>
        <tr>
            <td width="30%"> </td>
            <td ><label for = "pass"> <b>Password</b></label> </td>
            <td ><input type="password" id="pass" name="pass" style="color: #195d19; width: 30%;" > </td>
        </tr>
        <tr> <td><br> </td></tr>
        <tr>
            <td width="30%"> </td>
            <td ><label for = "address"> <b>Address</b></label> </td>
            <td ><input type="text" id="address" name="address" style="color: #195d19; width: 30%;" > </td>
        </tr>
        <tr><td> <br></td> </tr>
        <tr>
            <td width="30%"> </td>
            <td ><label for = "phone"> <b>Phone</b></label> </td>
            <td ><input type="number" id="phone" name="phone" style="color: #195d19; width: 30%;" > </td>
        </tr>
        <tr> <td><br> </td></tr>
        <tr>
            <td width="30%"> </td>
            <td ><label for = "email"> <b>Email</b></label> </td>
            <td ><input type="email" id="email" name="email" style="color: #195d19; width: 30%;" > </td>
        </tr>
        <tr><td><br> </td> </tr>
        <tr>
            <td width="30%"> </td>
            <td>  </td>
            <td ><input type="submit" value="Sign Up"  style="color: #195d19; width: 30%;" > </td>
        </tr>
    </table>

</form>


</body>
</html>


