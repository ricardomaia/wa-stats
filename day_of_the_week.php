<?php

$sql = "
SELECT strftime('%w',date) AS Dia, count(strftime('%Y',date)) AS Total,
CASE strftime('%w',date) 
    WHEN \"0\" THEN 'Sunday'
	WHEN \"1\" THEN 'Monday'
	WHEN \"2\" THEN 'Tuesday'
	WHEN \"3\" THEN 'Wednesday'
	WHEN \"4\" THEN 'Thursday'
	WHEN \"5\" THEN 'Friday'
	WHEN \"6\" THEN 'Saturday'
END AS \"Day of Week\"
FROM (SELECT DISTINCT user, date, time FROM stats) 
GROUP BY strftime('%w',date);";

$results = $db->query($sql);
$labels = "";
$data = "";

while ($row = $results->fetchArray()) {
    $labels .= "'{$row['Day of Week']}',";
    $data .= "'{$row['Total']}',";
}
?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?= $labels ?>],
            datasets: [{
                label: '# of Messages',
                data: [<?= $data ?>],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>