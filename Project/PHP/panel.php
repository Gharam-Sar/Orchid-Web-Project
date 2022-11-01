<?php
session_start();
$imgid = intval($_GET['id']);
$_SESSION['imgid'] = $imgid;
@$dp = new mysqli('localhost', 'root', '', 'orchid_store');
if (mysqli_connect_errno()) {
    echo '<script>alert("Can not connect to database")</script> ';
    die();
}


?>
<!DOCTYPE html>
<html>
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
</head>
<body>
<?php
if (isset($_SESSION['islogged'])) {
    $id = $_SESSION['islogged'];
    $Qry = "select * from site_users where ID = '$id'";
    $user = $dp->query($Qry);
    $r = $user->fetch_assoc();

    if ($r['User_level'] == 'manager') {
        ?>
        <form method="post" action="products.php">
            <div class="panel">
                <a href="javascript:void(0)" class="closebtn" onclick="hide('#p1')">&times;</a>
                <?php

                $strQry = "select * from products where ID = '$imgid'";
                $res = $dp->query($strQry);
                $row = $res->fetch_assoc();
                ?>

                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"' . '>' ?>

                <table id="#data">
                    <tr>
                        <td>
                            <input type="text" name="imgid" hidden value="<?php echo $row['ID']; ?>">
                            <?php echo "Name: "; ?>
                            <br><br>
                        </td>
                        <td>
                            <input name="name" type="text" value="<?php echo $row['Name']; ?>">
                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo "Price: "; ?>
                            <br><br>
                        </td>
                        <td>
                            <input name="price" type="text" value="<?php echo $row['Price']; ?> nis">

                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo "Amount: "; ?>
                            <br><br>
                        </td>
                        <td>
                            <input name="amount" type="text" value="<?php echo $row['Amount']; ?>">

                            <br><br>
                        </td>
                    </tr>
                </table>

                <table class="de" id="#desc" style="position: relative ;left: 300px; top: 100px;width: 70px;">
                    <tr>
                        <td style="padding-left: 5px">
                            <?php echo "Family:"; ?>
                            <br><br>
                        </td>
                        <td>
                            <input style="width: 160px" name="family" type="text" value="<?php echo $row['Family']; ?>">

                            <br><br>
                        </td>
                    </tr>

                    <tr>
                        <td><textarea readonly
                                      style="background-color: ghostwhite; width: 100px; border: none; resize: none; outline: none"
                                      rows="9"> <?php echo "Description: "; ?> </textarea></td>
                        <td><textarea name="desc"
                                      style=" resize: none; outline: none"
                                      rows="9"><?php echo $row['Description'] ?></textarea></td>
                    </tr>

                </table>
                <input id="deleteb" type="submit" name="delete" value="Delete">
                <input id="editb" type="submit" name="edit" value="Edit">
                <?php
                $dp->close();
                ?>
            </div>
        </form>
        <?php
    } else {

        ?>

        <div class="panel">
            <a href="javascript:void(0)" class="closebtn" onclick="hide('#p1')">&times;</a>
            <?php

            $strQry = "select * from products where ID = '$imgid'";
            $res = $dp->query($strQry);
            $row = $res->fetch_assoc();

            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"' . '>' ?>

            <table id="#data">

                <tr>
                    <td>
                        <?php echo "Name: "; ?>
                        <br><br>
                    </td>
                    <td>
                        <?php echo $row['Name']; ?>
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo "Price: "; ?>
                        <br><br>
                    </td>
                    <td>
                        <?php echo $row['Price']; ?>nis
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo "Family: "; ?>
                        <br><br>
                    </td>
                    <td>
                        <?php echo $row['Family']; ?>

                        <br><br>
                    </td>
                </tr>
            </table>

            <table class="de" id="#desc" style="position: relative ;left: 300px; top: 100px;width: 70px;">


                <tr>
                    <td><textarea readonly
                                  style="background-color: ghostwhite; width: 100px; border: none; resize: none; outline: none"
                                  rows="10"> <?php echo "Description: "; ?> </textarea></td>
                    <td><textarea readonly
                                  style="background-color: ghostwhite; border: none;resize: none; outline: none"
                                  rows="10"><?php echo $row['Description'] ?></textarea></td>
                </tr>

            </table>
            <input type="submit" id="buy" name="buy" value="Buy" onclick="buy()">
            <?php
            $dp->close();
            ?>
        </div>
        <?php


    }
} else {
    ?>

    <div class="panel">
        <a href="javascript:void(0)" class="closebtn" onclick="hide('#p1')">&times;</a>
        <?php

        $strQry = "select * from products where ID = '$imgid'";
        $res = $dp->query($strQry);
        $row = $res->fetch_assoc();

        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"' . '>' ?>

        <table id="#data">

            <tr>
                <td>
                    <?php echo "Name: "; ?>
                    <br><br>
                </td>
                <td>
                    <?php echo $row['Name']; ?>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo "Price: "; ?>
                    <br><br>
                </td>
                <td>
                    <?php echo $row['Price']; ?>nis
                    <br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo "Family: "; ?>
                    <br><br>
                </td>
                <td>
                    <?php echo' '. $row['Family']; ?>

                    <br><br>
                </td>
            </tr>
        </table>

        <table class="de" id="#desc" style="position: relative ;left: 300px; top: 100px;width: 70px;">
            <tr>
                <td><textarea readonly
                              style="background-color: ghostwhite; width: 100px; border: none; resize: none; outline: none"
                              rows="10"> <?php echo "Description: "; ?> </textarea></td>
                <td><textarea readonly style="background-color: ghostwhite; border: none;resize: none; outline: none"
                              rows="10"><?php echo $row['Description'] ?></textarea></td>
            </tr>

        </table>
        <input type="submit" id="buy" name="buy" value="Buy" onclick="buy()">
        <?php
        $dp->close();
        ?>
    </div>
    <?php
} ?>

</body>
</html>







