<?php

$sql = "
SELECT word FROM stats
WHERE word IN (
    SELECT word FROM (
        SELECT word, count(word) as Total FROM stats
        GROUP BY word
        ORDER BY Total DESC
        LIMIT 50
    )   
)
";
$results = $db->query($sql);
$dataset = "";

while ($row = $results->fetchArray()) {

    $dataset .= "{$row['word']},";
}
?>
<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 60vh;
    }
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/plugins/wordCloud.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end


        var chart = am4core.create("chartdiv", am4plugins_wordCloud.WordCloud);
        var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());

        series.accuracy = 4;
        series.step = 15;
        series.rotationThreshold = 0.7;
        series.maxCount = 200;
        series.minWordLength = 2;
        series.labels.template.margin(4, 4, 4, 4);
        series.maxFontSize = am4core.percent(30);

        series.text = "<?= $dataset ?>";

        series.colors = new am4core.ColorSet();
        series.colors.passOptions = {}; // makes it loop

        //series.labelsContainer.rotation = 45;
        series.angles = [0, -90];
        series.fontWeight = "700"

        setInterval(function() {
            series.dataItems.getIndex(Math.round(Math.random() * (series.dataItems.length - 1))).setValue("value", Math.round(Math.random() * 10));
        }, 10000)

    }); // end am4core.ready()
</script>