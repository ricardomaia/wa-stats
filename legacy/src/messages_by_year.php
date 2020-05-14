<?php

$sql = "SELECT strftime('%Y',date) as Ano, count(strftime('%Y',date)) as Total 
FROM (SELECT DISTINCT user, date, time FROM stats) GROUP BY strftime('%Y',date);";
$results = $db->query($sql);
$labels = "";
$data = "";

while ($row = $results->fetchArray()) {
    $labels .= "'{$row['Ano']}',";
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