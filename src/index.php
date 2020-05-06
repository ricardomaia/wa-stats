<?php

/**
 * wa-stats.php
 * 
 * Quick and dirty Whatsapp statistics.
 * 
 * @author      Ricardo Maia
 * @copyright   2020 Ricardo Maia
 * @link        https://github.com/ricardomaia/wa-stats.git
 * @license     https://www.gnu.org/licenses/gpl-3.0.en.html
 * @version     0.1.0
 * @todo        Parse emoji characters.
 */

$dbfile = '../db.sqlite';
$db = new SQLite3($dbfile);
$labels = "";
$data = "";

$option = isset($_GET['op']) ? $_GET['op'] : 'time_of_the_day';

switch ($option) {
    case "messages_by_year":
        $graph = "messages_by_year.php";
        break;

    case "day_of_the_week":
        $graph = "day_of_the_week.php";
        break;

    case "time_of_the_day":
        $graph = "time_of_the_day.php";
        break;

    case "time_by_week_day":
        $graph = "time_by_week_day.php";
        break;

    case "messages_by_user":
        $graph = "messages_by_user.php";
        break;

    case "commom_words":
        $graph = "commom_words.php";
        break;
    case "messages_by_day":
        $graph = "messages_by_day.php";
        break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WA-STATS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"> </script>


</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading"><img src="images/wa-stats-logo-0.svg" style="height: 72px;"></div>
            <div class=" list-group list-group-flush">

                <a href="?op=time_of_the_day" class="list-group-item list-group-item-action bg-dark">Time of the day</a>
                <a href="?op=day_of_the_week" class="list-group-item list-group-item-action bg-dark">Day of the week</a>
                <a href="?op=messages_by_year" class="list-group-item list-group-item-action bg-dark">Messages by year</a>
                <a href="?op=time_by_week_day" class="list-group-item list-group-item-action bg-dark">Time by week day</a>
                <a href="?op=messages_by_user" class="list-group-item list-group-item-action bg-dark">Messages by user</a>
                <a href="?op=messages_by_day" class="list-group-item list-group-item-action bg-dark">Messages by day</a>
                <a href="?op=commom_words" class="list-group-item list-group-item-action bg-dark">Top words</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
                <button class="btn btn-secondary btn-sm" id="menu-toggle"><span class="oi oi-menu"></span></button>

            </nav>
            <div class="col-md-auto">
                <div id="chartdiv"></div>
            </div>

            <div class="container-fluid">

                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <canvas id="myChart"></canvas>

                        </div>
                        <div class="col-sm">
                            <!-- Column Two -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <?php include_once($graph); ?>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>

<?php $db->close(); ?>