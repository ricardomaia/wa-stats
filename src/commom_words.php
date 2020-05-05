<?php

$sql = "
SELECT lower(word) AS word, count(lower(word)) AS Total FROM stats 
WHERE word NOT IN ('media')
GROUP BY word ORDER BY Total DESC
LIMIT 300
";
$results = $db->query($sql);
$dataset = "";

while ($row = $results->fetchArray()) {

    $dataset .= "{\"word\": \"{$row['word']}\", \"count\": \"{$row['Total']}\" },";
}
?>
<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 80vh;
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
        chart.fontFamily = "Corbel, Arial, Sans-Serif";
        var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());

        /*
                series.events.on("arrangestarted", function(ev) {
                    ev.target.baseSprite.preloader.show(0);
                });

                series.events.on("arrangeprogress", function(ev) {
                    ev.target.baseSprite.preloader.progress = ev.progress;
                });
        */

        series.randomness = 0.2;
        series.rotationThreshold = 0.5;

        series.data = [<?= $dataset ?>];

        series.dataFields.word = "word";
        series.dataFields.value = "count";
        series.colors = new am4core.ColorSet();
        series.colors.passOptions = {};

        series.labels.template.tooltipText = "{word}:\n[bold]{count}[/]";


        var hoverState = series.labels.template.states.create("hover");
        hoverState.properties.fill = am4core.color("#FF0000");
        var title = chart.titles.create();
        title.text = "TOP common words";
        title.fontSize = 28;
        title.fontWeight = "800";

    }); // end am4core.ready()
</script>
<!-- HTML -->
<div id="chartdiv"></div>