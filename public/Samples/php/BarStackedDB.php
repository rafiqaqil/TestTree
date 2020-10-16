<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Bar Stacked DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
  $de->sqlStatement = 'SELECT * FROM AreaData';
  $de->dataFields = 'xAxis=DatePeriod,yAxis=Purchases,yAxis=Taxes,yAxis=Supplies,yAxis=Rent';
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
Query a MySQL Database using PHP to get multiple stacked bar series on a chart.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
chart = JSC.Chart('chartDiv', {
  title_label_text: '2020 Spending',
  legend_position: 'inside top',
  yAxis: {
    formatString: 'c',
    label_text: 'Spent (USD)',
    scale_type: 'stacked'
  },
  xAxis: {
    label_text: 'Month',
    scale_interval: 1,
    defaultTick_label_text: xAxisFormatter
  },
  defaultSeries: { type: 'column', opacity: 0.85  },
  defaultPoint_tooltip: '%seriesName <b>%yValue</b><br/>{%percentOfGroup:n1}% of this month\'s cost<br/>{%percentOfTotal:n1}% of 2020 cost',
  toolbar_visible: false,
  series: php_var ? JSON.parse(php_var) : undefined
});

  function xAxisFormatter(val){
      return JSC.formatDate(new Date(2020,val-1,1),'MMM');
  }


</script>
	</body>
</html>