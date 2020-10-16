<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Year DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$startDate = new DateTime('2014-1-1');
$endDate = new DateTime('2014-12-31 23:59:59');
$title = 'Orders From ' . date_format($startDate, 'm/d/Y') . ' to ' . date_format($endDate, 'm/d/Y') . ',  Total : %sum';
$de = new DataEngine();
$de->addParameter($startDate);
$de->addParameter($endDate);
$de->sqlStatement = 'SELECT OrderDate AS Month, SUM(1) AS Orders FROM Orders
WHERE OrderDate >=? And OrderDate <=?
    GROUP BY MONTH(OrderDate)
    ORDER BY MONTH(OrderDate);';
    $de->dataFields = 'xAxis=Month,yAxis=Orders'; //default setting
    $de->dateGrouping = "year";
    $series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get data for a year grouped by months.
Learn how to:

  - Select MySQL database data based on a date range.
  - Use DataEngine DateGrouping feature with MySQL a database to get results based on years.
  - Sort MySQL database results by dates.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
php_title = <?php echo json_encode($title) ?>,
chart = new JSC.Chart('chartDiv',{

    title_label_text: php_title,
    palette:['#c099ec'],
    legend_visible: false,
    defaultSeries_type: 'column',
    defaultPoint_tooltip: '{%percentOfTotal:n1}% of 2014 %seriesName',

    yAxis_label_text: 'Number of Orders',
    xAxis: {
        formatString:'MMM',
        label_text: 'Month',
        scale: {type:'time',interval_unit:'month'  }
    },
    series: php_var ? JSON.parse(php_var) : undefined
});


</script>
	</body>
</html>