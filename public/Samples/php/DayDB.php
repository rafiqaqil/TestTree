<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Day DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$startDate = new DateTime('2014-11-11 00:00:00');
$endDate = new DateTime('2014-11-11 23:59:59');
$title = 'Sales for ' . date_format($startDate, 'm/d/Y') . ',  Total : {%sum:c}';
$de = new DataEngine();
$de->addParameter($startDate);
$de->addParameter($endDate);
$de->sqlStatement = 'SELECT OrderDate AS Hours, SUM(Total) AS Sales FROM Orders
WHERE OrderDate >=? And OrderDate <=?
    GROUP BY HOUR(OrderDate)
    ORDER BY HOUR(OrderDate);';
    $de->dataFields = 'xAxis=Hours,yAxis=Sales'; //default setting
    $de->dateGrouping = "day";
    $series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 380px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get data grouped by hours of the day.
Learn how to:

  - Select MySql database data based on a date range.
  - Use DataEngine DateGrouping feature with MySql a database to get results based on day.
  - Sort MySql database results by dates.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
php_title = <?php echo json_encode($title) ?>,
    chart = new JSC.Chart('chartDiv',{
  legend_visible: false,
  title_label_text: php_title,
  defaultSeries_type: 'column',
  palette: [ '#6e9876'  ],
  defaultPoint: {
    label_text: '%yValue',
    tooltip: '{%percentOfTotal:n1}% of 2014 %seriesName'
  },
  yAxis: { label_text: 'Sales (USD)', formatString: 'c'  },
  xAxis: {
    formatString: 'HH',
    label_text: 'Hour',
    scale: {
      interval: {  unit: 'hour',  multiplier: 1},
      type: 'time'
    }
  },
  series: php_var ? JSON.parse(php_var) : undefined
});


</script>
	</body>
</html>