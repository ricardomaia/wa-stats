<?php

$sql = "
SELECT date, count(date) as Total,
CASE strftime('%w',date) 
    WHEN \"0\" THEN 'Sunday'
	WHEN \"1\" THEN 'Monday'
	WHEN \"2\" THEN 'Tuesday'
	WHEN \"3\" THEN 'Wednesday'
	WHEN \"4\" THEN 'Thursday'
	WHEN \"5\" THEN 'Friday'
	WHEN \"6\" THEN 'Saturday'
END AS \"Dia da Semana\"  
FROM
(SELECT DISTINCT user, date, time FROM stats) 
GROUP BY date
ORDER BY date ASC";

$results = $db->query($sql);
$labels = "";
$data = "";

while ($row = $results->fetchArray()) {
    $data .= "{ x: new Date('{$row['date']}'), y: {$row['Total']} },";
}
?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
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
                xAxes: [{
                    type: 'time',
                    distribution: 'series',
                    time: {
                        displayFormats: {
                            day: 'YYYY-MM-DD'
                        }

                    }
                }]
            }
        }
    });
</script>