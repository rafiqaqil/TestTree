<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Multi Chart DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
//First Chart Data
$de = new DataEngine();
$startDate = new DateTime('2014-1-1');
$endDate = new DateTime('2014-12-31 23:59:59');
$de->addParameter($startDate);
$de->addParameter($endDate);
$title = 'Orders From ' . date_format($startDate, 'm/d/Y') . ' to ' . date_format($endDate, 'm/d/Y');
$de->sqlStatement = 'SELECT MONTH(OrderDate) AS Month, SUM(1) AS Orders FROM Orders
WHERE OrderDate >=? And OrderDate <=? GROUP BY MONTH(OrderDate)ORDER BY MONTH(OrderDate);';
$series = $de->getSeries();

//Second Chart Data
$de = new DataEngine();
$de->addParameter($startDate);
$de->addParameter($endDate);
$title2 = 'Sales From ' . date_format($startDate, 'm/d/Y') . ' to ' . date_format($endDate, 'm/d/Y');
$de->sqlStatement = 'SELECT MONTH(OrderDate) AS Month, SUM(Total) AS Sales FROM Orders
WHERE OrderDate >=? And OrderDate <=? GROUP BY MONTH(OrderDate)ORDER BY MONTH(OrderDate);';
$series2 = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="cc" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
            <div id="cc2" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Multiple charts that query a Database using PHP.
Learn how to:

  - Select MySql database data based on a date range.
  - Create a chart title using PHP.
*/
// JS
var chart,chart2,
	php_var = <?php echo json_encode($series) ?>,
	php_var2 = <?php echo json_encode($series2) ?>,
	title1 = <?php echo json_encode($title) ?>,
	title2 = <?php echo json_encode($title2) ?>;

//First Chart
var chartJson = {
	title_label_text: title1,
	defaultSeries_type: 'column',
	defaultPoint: {
		color: '#FF6600',
		tooltip: '%yValue <br/>{%percentOfTotal:n1}% of 2014 %seriesName'
	},
	toolbar_visible: true,
	xAxis: {
		label_text: 'Month',
		scale_interval: 1,
		defaultTick_label_text: xAxisFormatter
	},
	yAxis_label_text: 'Number of Orders',
	legend_position: 'inside left top',
	series:php_var && JSON.parse(php_var)
};

//Second Chart
var chart2Json = {
	palette: 'fiveColor2',
	title_label_text: title2,
	defaultSeries_type: 'column',
	defaultPoint_tooltip: '%yValue <br/>{%percentOfTotal:n1}% of 2014 %seriesName',
	toolbar_visible: true,
	xAxis: {
		label_text: 'Month',
		scale_interval: 1,
		defaultTick_label_text: xAxisFormatter
	},
	yAxis_formatString: 'c',
	yAxis_label_text: 'Sales (USD)',
	legend_position: 'inside left top',
	series:php_var2 && JSON.parse(php_var2)
};

chart = new JSC.Chart('cc', chartJson, function () {	chart2 = new JSC.Chart('cc2', chart2Json);});


function xAxisFormatter(val) {
	return JSC.formatDate(new Date(2014, val - 1, 1), 'MMM');
}


</script>
	</body>
</html>