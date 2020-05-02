<?php

$sql = "
SELECT user, count(user) as Total from (
SELECT DISTINCT user, date, time FROM stats
) GROUP BY user ORDER BY Total DESC
";
$results = $db->query($sql);
$labels = "";
$data = "";

while ($row = $results->fetchArray()) {
    $labels .= "'{$row['user']}',";
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