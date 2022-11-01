<?php

session_start();
@$dp = new mysqli('localhost', 'root', '', 'orchid_store');
if (mysqli_connect_errno()) {
    echo '<script>alert("Can not connect to database")</script> ';
    die();
}
$strQry = "select count(Family),Family from products group by Family";
$res = $dp->query($strQry);

$count = '';
$family = '';
for ($i = 0; $i < $res->num_rows; $i++) {
    $row = $res->fetch_assoc();
    $count = $count . '"' . $row['count(Family)'] . '",';
    $family = $family . '"' . $row['Family'] . '",';

}
$count = trim($count, ',');
$family = trim($family, ',');

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    echo $type;
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script type="text/javascript"
            src="modules/dashboards/js/jquery.min.js">
    </script>
    <script type="text/javascript"
            src="modules/dashboards/js/Chart.min.js">
    </script>
    <script type="text/javascript" src="modules/dashboards/js/app.js">
    </script>
    <link rel="stylesheet" href="../Css/statics.css">
<!--    <style>-->
<!---->
<!---->
<!--        #wanted {-->
<!---->
<!--            position: absolute;-->
<!--            width: 550px;-->
<!--            height: 550px;-->
<!--            top: 20%;-->
<!--            left: 30%;-->
<!---->
<!--        }-->
<!---->
<!--    </style>-->
</head>
<body>


<canvas id="myChart" width="400px" height="400px"></canvas>


<script>

    $(document).ready(function () {
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type:<?php echo $type;?> ,
            data: {
                labels: [<?php echo $family;?>],
                datasets: [{
                    label: 'Number of plants in each family',
                    data: [<?php echo $count;?>],
                    backgroundColor: [
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
    });
</script>
<h1><b>Number of plants in each family</b></h1>

<?php
//header("location:index.php");
?>
</body>
</html>