<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Data", "Count", { role: "style" } ],
            ["Total Post", 15, "#6621e5"],
            ["Published Post", 10, "#3d578b"],
            ["Draft Post", 5, "#6495ED"],
            ["Published Comment", 5, "#CD5C5C"],
            ["New Comment", 5, "#DC143C"],
            ["Admin", 4, "#008B8B"],
            ["Subscriber", 3, "#7FFFD4"],
            ["Categories", 2, "#E9967A"]

        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            title: "DATABASE",
            width: 1000,
            height: 400,
            bar: {groupWidth: "50%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
</script>
<div id="columnchart_values" style="width: auto; height: 500px;"></div>

</body>
</html>