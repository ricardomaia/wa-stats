<?php

$sql = "
SELECT strftime('%w',date) as Day, strftime('%H',time) as Time, count(strftime('%H',time)) as Total,
CASE strftime('%w',date) 
    WHEN \"0\" THEN 'Sunday'
	WHEN \"1\" THEN 'Monday'
	WHEN \"2\" THEN 'Tuesday'
	WHEN \"3\" THEN 'Wednesday'
	WHEN \"4\" THEN 'Thursday'
	WHEN \"5\" THEN 'Friday'
	WHEN \"6\" THEN ''
END AS \"Week Day\" 
FROM (SELECT DISTINCT user, date, time FROM stats) 
GROUP BY strftime('%H',time), strftime('%w',date)
";
$results = $db->query($sql);
$labels = "";
$dataset = "";

while ($row = $results->fetchArray()) {

    $day = (int) $row['Day'] + 1;
    $dataset .= "{ x: {$day},  y: {$row['Time']}, r: {$row['Total']}},";
    $r = rand(0, 255);
    $g = rand(0, 255);
    $b = rand(0, 255);
    $dataset2 .= "
    {
        label: '{$row['Week Day']}    ',
        data: [{ x: {$day},  y: {$row['Time']}, r: {$row['Total']} }],
        backgroundColor: 'rgba({$r}, {$g}, {$b}, 0.6)',
        hoverRadius: 20
    },
    ";
}
?>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bubble',
        data: {

            datasets: [{
                label: 'Total messsages',
                data: [<?= $dataset ?>],
                hoverBackgroundColor: 'rgba(255, 0, 0, 0.6)',
                pointStyle: 'circle',
                hoverRadius: 20
            }, ],

        }
    });
</script>