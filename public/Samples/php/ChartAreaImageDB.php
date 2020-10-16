<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Chart Area Image DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
  $de->sqlStatement = 'SELECT Sum(Purchases) as Purchases, Sum(Taxes) as Taxes,Sum(Supplies) as Supplies,Sum(Rent) as Rent, CASE WHEN  DatePeriod BETWEEN 1 AND  3 THEN "1" WHEN  DatePeriod BETWEEN 4 AND  6 THEN "2" WHEN  DatePeriod BETWEEN 7 AND  9 THEN "3" WHEN  DatePeriod BETWEEN 10 AND 12 THEN "4" END AS "Quarter" FROM AreaData Group by Quarter';
  $de->dataFields = 'name=Quarter,yAxis=Purchases,yAxis=Taxes,yAxis=Supplies,yAxis=Rent';
  $series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 640px; height: 400px;margin: 0px auto;">
</div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get multiple shaded bar series on a chart with a background image.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
chart = JSC.Chart('chartDiv', {
  title_label_text: '2020 Spending',
  chartArea_fill_image: '../images/background2.jpg',
  legend_position: 'bottom',
  yAxis: { formatString: 'c', label_text: 'Spent (USD)'  },
  xAxis: {
    label_text: 'Quarter',
    scale_interval: 1,
    defaultTick_label_text: '{new Date(2020,((%value-1)*3),1):MMM} (Q%value)'
  },
  defaultSeries: { type: 'column'  },
  defaultPoint_tooltip: '%seriesName <b>%yValue</b><br/>{%percentOfGroup:n1}% of this month\'s cost<br/>{%percentOfTotal:n1}% of 2020 cost',
  toolbar_visible: false,
  series: php_var ? JSON.parse(php_var) : undefined
});


</script>
	</body>
</html>