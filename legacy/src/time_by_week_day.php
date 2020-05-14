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
	WHEN \"6\" THEN 'Saturday'
END AS \"Week Day\" 
FROM (SELECT DISTINCT user, date, time FROM stats) 
GROUP BY strftime('%H',time), strftime('%w',date)
";
$results = $db->query($sql);
$labels = "";
$dataset = "";
$currentDay = null;
$lastDay = 99;

while ($row = $results->fetchArray()) {

    $currentDay = $row['Day'];
    if ($currentDay != $lastDay) {
        $dataset .= "[";
    }
    $dataset .= "{$row['Total']},";
}
function randomizeColor()
{
    $r = rand(0, 255);
    $g = rand(0, 255);
    $b = rand(0, 255);
    return "rgba({$r}, {$g}, {$b}, 0.6)";
}

?>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
            datasets: [{
                    label: 'Sunday',
                    data: [30, 4, 0, 0, 0, 0, 3, 10, 15, 34, 50, 60, 80, 121, 132, 111, 113, 120, 136, 147, 155, 140, 90, 45],
                    backgroundColor: '<?= randomizeColor() ?>',
                    borderColor: 'rgba(33, 0, 0, 0.6)',
                },
                {
                    label: 'Monday',
                    data: [0, 0, 10, 0, 30, 0, 0, 0, 0, 0, 0, 40, 20, 32],
                    backgroundColor: '<?= randomizeColor() ?>',
                    borderColor: 'rgba(20, 50, 0, 0.6)',
                },
                {
                    label: 'Tuesday',
                    data: [0, 0, 10, 0, 30, 0, 0, 0, 0, 0, 0, 40, 20, 32],
                    backgroundColor: '<?= randomizeColor() ?>',
                    borderColor: 'rgba(20, 50, 0, 0.6)',
                },
                {
                    label: 'Wednesday',
                    data: [0, 0, 10, 0, 30, 0, 0, 0, 0, 0, 0, 40, 20, 32],
                    backgroundColor: '<?= randomizeColor() ?>',
                    borderColor: 'rgba(20, 50, 0, 0.6)',
                },
                {
                    label: 'Thursday',
                    data: [0, 0, 10, 0, 30, 0, 0, 0, 0, 0, 0, 40, 20, 32],
                    backgroundColor: '<?= randomizeColor() ?>',
                    borderColor: 'rgba(20, 50, 0, 0.6)',
                },
                {
                    label: 'Friday',
                    data: [0, 0, 10, 0, 30, 0, 0, 0, 0, 0, 0, 40, 20, 32],
                    backgroundColor: '<?= randomizeColor() ?>',
                    borderColor: 'rgba(20, 50, 0, 0.6)',
                },
                {
                    label: 'Saturday',
                    data: [0, 0, 10, 0, 30, 0, 0, 0, 0, 0, 0, 40, 20, 32],
                    backgroundColor: '<?= randomizeColor() ?>',
                    borderColor: 'rgba(20, 50, 0, 0.6)',
                },

            ],

        }
    });
</script>