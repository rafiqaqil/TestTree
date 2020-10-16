<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Month DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$startDate = new DateTime('2014-10-1');
$endDate = new DateTime('2014-10-31 23:59:59');
$title = 'Sales From ' . date_format($startDate, 'm/d/Y') . ' to ' . date_format($endDate, 'm/d/Y') . ',  Total : %sum';
$de = new DataEngine();
$de->addParameter($startDate);
$de->addParameter($endDate);
$de->sqlStatement = 'SELECT OrderDate AS Month, SUM(Total) AS Sales FROM Orders
WHERE OrderDate >=? And OrderDate <=?
    GROUP BY DAY(OrderDate)
    ORDER BY DAY(OrderDate);';
    $de->dataFields = 'xAxis=Month,yAxis=Sales'; //default setting
    $de->dateGrouping = "Month";
    $series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get day data for a month.
Learn how to:

  - Select MySql database data based on a date range.
  - Group MySql database results based on month number of dates.
  - Sort MySql database results by dates.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
	php_title = <?php echo json_encode($title) ?>,
	chart = new JSC.Chart('chartDiv', {
		title_label_text: php_title,
		palette: ['crimson'],
		legend_visible: false,
		defaultSeries_type: 'column',
		xAxis_label_text: 'Day of Month',
		yAxis_label_text: 'Sales (USD)',
		yAxis_formatString: 'c',
		xAxis: {
			formatString: 'dd',
			label_text: 'Days',
			scale: {interval: {unit: 'day'}, type: 'time'}
		},
		series: php_var && JSON.parse(php_var)
	});


</script>
	</body>
</html>