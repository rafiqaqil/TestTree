<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Master Details DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$startDate = new DateTime('2014-1-1');
$endDate = new DateTime('2014-12-31 23:59:59');
$title = 'Total Sales: %sum From ' . date_format($startDate, 'm/d/Y') . ' to ' . date_format($endDate, 'm/d/Y');
$de->addParameter($startDate);
$de->addParameter($endDate);
$de->dataFields = 'name=Month,yAxis=Total Sales';
$de->sqlStatement = 'SELECT YEAR(OrderDate) AS Year, MONTH(OrderDate) AS Month, SUM(Total) AS "Total Sales" FROM Orders
WHERE OrderDate >=? And OrderDate <=? GROUP BY YEAR(OrderDate), MONTH(OrderDate)
ORDER BY YEAR(OrderDate), MONTH(OrderDate);';
$de->dateGrouping = "Year";//This setting shows all the months in the year regardless of having data on that month or not.
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="masterChart" style="width: 740px; height: 380px; margin: 0px auto;" >
                </div>
            <br/>
            <div id="detailsChart" style="width: 740px; height: 380px; margin: 0px auto;" >
                </div>
	
<script type="text/javascript">
/*
Query a Database using a PHP script page to serve the detailed monthly data.
Learn how to:

  - Format dates as year numbers from a MySql database.
  - Use the PHP DataEngine dateGrouping feature with MySql.
  - Use a PHP script file to load data dynamically from MySql with Ajax.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
php_title = <?php echo json_encode($title) ?>,
startDate = new Date(2014, 1, 1, 0, 0, 0, 0);

var chart, chart2;

JSC.ready().then(function () {	getData('2014-01-01');});

chart = new JSC.Chart('masterChart', {
	legend_visible: false,
	title_label_text: php_title,
	type: 'column',
	defaultSeries: {		pointSelection: true,		palette: 'default'	},
	toolbar_visible: true,
	xAxis: {
		label_text: 'Month',
		scale_interval: 1,
		defaultTick_label_text: xAxisFormatter
	},
	yAxis_formatString: 'c',
	defaultPoint_events_click: pointClick,
	annotations: [{
		label_text: 'Click a bar to see details for that month.',
		position: 'inside top left'
	}],
	series: php_var ? JSON.parse(php_var) : undefined

}, function () {
	/*Select the first point in this chart*/
	this.series(0).points(0).select(true);
	getData('2014-01-01');
});

function processChart(json2, fromDate, color) {

	var points = json2.series[0].points.data.map(function (p) {
		return {			id: p[0],			name: p[0],			y: p[1]		}
	});
	if (!chart2) {
		chart2 = new JSC.Chart('detailsChart', {
			type: 'column',
			xAxis_label_text: 'Days',
			legend_visible: false,
			yAxis_formatString: "c",
			title: json2.title,
			series: json2.series
		});
	} else {
		chart2.series(0).options({color: color, points: points})
		chart2.options({title: json2.title});
	}
}

function getData(fromDate, color) {
	if (!fromDate) {		fromDate = "2014-1-1";	}
	JSC.fetch("MasterDetailsDataDB.php?startDate=" + fromDate).then(function (response) {		return response.json();	}).then(function (json) {		processChart(json, fromDate, color);	});

}

function xAxisFormatter(val) {
	return JSC.formatDate(new Date(2014, val, 1), 'MMM');
}

function pointClick(e) {
	getData(this.replaceTokens(startDate.getFullYear() + '-%name-01'), this.replaceTokens('%color'));
}


</script>
	</body>
</html>