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


$strQry = "select count(Family),Family from products group by Family";
$res = $dp->query($strQry);

$countf = '';
$family = '';

for ($i = 0; $i < $res->num_rows; $i++) {
    $row = $res->fetch_assoc();
    $countf = $countf . '"' . $row['count(Family)'] . '",';
    $family = $family . '"' . $row['Family'] . '",';

}
$countf = trim($countf, ',');
$family = trim($family, ',');

$userQry = "select count(Address),Address from site_users group by Address";
$userres = $dp->query($userQry);

$countu = '';
$city = '';

for ($i = 0; $i < $userres->num_rows; $i++) {
    $urow = $userres->fetch_assoc();
    $countu = $countu . '"' . $urow['count(Address)'] . '",';
    $city = $city . '"' . $urow['Address'] . '",';

}
$countu = trim($countu, ',');
$city = trim($city, ',');

$orderQry = "select count(Pname),Pname from orders group by Pname";
$orderres = $dp->query($orderQry);

$counto = '';
$plant = '';

for ($i = 0; $i < $orderres->num_rows; $i++) {
    $orow = $orderres->fetch_assoc();
    $counto = $counto . '"' . $orow['count(Pname)'] . '",';
    $plant = $plant . '"' . $orow['Pname'] . '",';

}
$counto = trim($counto, ',');
$plant = trim($plant, ',');


$statQry = "select count(Status),Status from orders group by Status";
$statres = $dp->query($statQry);

$counts = '';
$status = '';

for ($i = 0; $i < $statres->num_rows; $i++) {

    $srow = $statres->fetch_assoc();
    $counts = $counts . '"' . $srow['count(Status)'] . '",';
    $status = $status . '"' . $srow['Status'] . '",';

}
$counts = trim($counts, ',');
$status = trim($status, ',');


$moQry = "select Date from orders";
$mores = $dp->query($moQry);

$countm = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);

for ($i = 0; $i < $mores->num_rows; $i++) {

    $morow = $mores->fetch_assoc();
    $date = $morow['Date'];
    list($year, $month, $day) = explode('/', $date);
    $t = ($month);
    $countm[$month] = $countm[$month] + 1;

}


$countm = implode(",", $countm);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statics</title>
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
    <!--    <link rel="stylesheet" href="../Css/procuctsheet.css">-->
    <link rel="stylesheet" href="../Css/statics.css">
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script src="../JS/products.js"></script>

    <script>
        function showPlants(str) {


            //
            // $(document).ready(function () {
            //     if (str == "") {
            //         document.getElementById("wanted").innerHTML = "";
            //         return;
            //     } else {
            //         var xmlhttp = new XMLHttpRequest();
            //         xmlhttp.open("GET", "plants.php", false);
            //         xmlhttp.send();
            //
            //         document.getElementById("wanted").innerHTML = this.responseText;
            //
            //
            //     }
            // });

            $(document).ready(function () {
                let ctx = document.getElementById('myChart').getContext('2d');
                if (str == "") {
                    document.getElementById('wanted').style.display = "none";
                    return;
                }
                document.getElementById('wanted').style.display = "block";

                if (str == 1) {

                    let chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php echo $family;?>],

                            datasets: [{
                                label: 'Number of plants in each family',
                                data: [<?php echo $countf;?>],
                                backgroundColor: [
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(174,129,161)',
                                    'rgb(174,129,161)',
                                    'rgb(112,84,140)'


                                ],

                                borderColor: [
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)'
                                ],

                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{

                                    ticks: {
                                        beginAtZero: true,

                                    }
                                }]


                            },

                            responsive: true,

                        }
                    });

                }
                else if (str == 2) {
                    let chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php echo $plant;?>],

                            datasets: [{
                                label: 'Plant sales',
                                data: [<?php echo $counto;?>],
                                backgroundColor: [
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(174,129,161)',
                                    'rgb(112,84,140)'


                                ],

                                borderColor: [
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)'
                                ],

                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{

                                    ticks: {
                                        beginAtZero: true,

                                    }
                                }]


                            },

                            responsive: true,

                        }
                    });

                }
                else if (str == 3) {
                    let chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php echo $city;?>],

                            datasets: [{
                                label: 'User distribution in each city',
                                data: [<?php echo $countu;?>],
                                backgroundColor: [
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(174,129,161)',
                                    'rgb(112,84,140)'


                                ],

                                borderColor: [
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)'
                                ],

                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{

                                    ticks: {
                                        beginAtZero: true,

                                    }
                                }]


                            },


                            responsive: true,

                        }
                    });
                }
                else if (str == 4) {
                    let chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php echo $status; ?>],

                            datasets: [{
                                label: 'Order Status',
                                data: [<?php echo $counts;?>],
                                backgroundColor: [
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(174,129,161)',
                                    'rgb(112,84,140)'


                                ],

                                borderColor: [
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)'
                                ],

                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{

                                    ticks: {
                                        beginAtZero: true,

                                    }
                                }]


                            },


                            responsive: true,

                        }
                    });
                }
                else if (str == 5) {
                    let chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],

                            datasets: [{
                                label: 'Order Status',
                                data: [<?php echo $countm;?>],
                                backgroundColor: [
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(234,141,162)',
                                    'rgb(117,104,177)',
                                    'rgb(236,184,191)',
                                    'rgb(174,129,161)',
                                    'rgb(112,84,140)'


                                ],

                                borderColor: [
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)',
                                    'rgb(190,190,190)'
                                ],

                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{

                                    ticks: {
                                        beginAtZero: true,

                                    }
                                }]


                            },


                            responsive: true,

                        }
                    });
                }


            });

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
    <form>
        <select name="statics" id="statics" onchange="showPlants(this.value);">
            <option id="option" value="">Statics:</option>
            <option id="option" value="1">Families of plants</option>
            <option id="option" value="2">Plant sales</option>
            <option id="option" value="3">Users distribution in cities</option>
            <option id="option" value="4">Order status</option>
            <option id="option" value="5">Sales in each month</option>
        </select>
    </form>
</div>

<div id="wanted" style="display: none;bottom: 50px">
    <canvas id="myChart" width="400px" height="400px"></canvas>
</div>

</body>
</html>
