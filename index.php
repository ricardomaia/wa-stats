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

    $dbfile = './db.sqlite';
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

  <html>

  <head>

      <style>
          body {
              font: 10px sans-serif;
          }

          #container {
              width: 80vw;

          }

          ul {
              list-style-type: none;
              margin: 0;
              padding: 0;
              overflow: hidden;
              background-color: #333333;
          }

          li {
              float: left;
          }

          li a {
              display: block;
              color: white;
              text-align: center;
              padding: 16px;
              text-decoration: none;
          }

          li a:hover {
              background-color: #111111;
          }
      </style>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"> </script>

  </head>

  <body>
      <ul>
          <li><a href="?op=time_of_the_day">Time of the day</a></li>
          <li><a href="?op=day_of_the_week">Day of the week</a></li>
          <li><a href="?op=messages_by_year">Messages by year</a></li>
          <li><a href="?op=time_by_week_day">Time by week day</a></li>
          <li><a href="?op=messages_by_user">Messages by user</a></li>
          <li><a href="?op=messages_by_day">Messages by day</a></li>
          <li><a href="?op=commom_words">Top words</a></li>
      </ul>

      <div id="container">
          <canvas id="myChart"></canvas>
      </div>
      <?php include_once($graph); ?>
  </body>

  </html>

  <?php $db->close(); ?>