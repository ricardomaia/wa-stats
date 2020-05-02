<?php

$sql = "
SELECT lower(word) AS word, count(lower(word)) AS Total FROM stats 
WHERE word NOT IN ('media')
GROUP BY word ORDER BY Total DESC
LIMIT 200
";
$results = $db->query($sql);
$dataset = "";

while ($row = $results->fetchArray()) {

    $dataset .= "{\"tag\": \"{$row['word']}\", \"count\": \"{$row['Total']}\" },";
}
?>
<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 50vh;
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
        chart.fontFamily = "Courier New";
        var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());
        series.randomness = 0.1;
        series.rotationThreshold = 0.5;

        series.data = [<?= $dataset ?>];


        series.dataFields.word = "tag";
        series.dataFields.value = "count";

        series.heatRules.push({
            "target": series.labels.template,
            "property": "fill",
            "min": am4core.color("#0000CC"),
            "max": am4core.color("#CC00CC"),
            "dataField": "value"
        });

        var hoverState = series.labels.template.states.create("hover");
        hoverState.properties.fill = am4core.color("#FF0000");
        var title = chart.titles.create();
        title.text = "TOP #100 common words";
        title.fontSize = 28;
        title.fontWeight = "800";

    }); // end am4core.ready()
</script>
<!-- HTML -->
<div id="chartdiv"></div>