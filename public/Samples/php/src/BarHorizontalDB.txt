<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Bar Horizontal DB | JSCharting</title>
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
	<div id="chartDiv" style="max-width: 540px;height: 600px;margin: 0px auto;">
</div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get multiple bar series on a horizontal chart.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS

var php_var = <?php echo json_encode($series) ?>,
  chart = new JSC.Chart('chartDiv',{
  targetElement: 'chartDiv',
  type: 'horizontal',
  title_label_text: '2020 Spending',
  defaultSeries: { type: 'column', opacity: 0.85  },
  yAxis: { formatString: 'c', label_text: 'Spent (USD)'  },
  xAxis: {
    label_text: 'Month',
    scale_interval: 1,
    defaultTick_label_text: xAxisFormatter
  },
  legend_position: 'inside right bottom',
  defaultPoint_tooltip: '%seriesName <b>%yValue</b><br/>{%percentOfGroup:n1}% of this month\'s cost<br/>{%percentOfTotal:n1}% of 2020 cost',
  series: php_var ? JSON.parse(php_var) : undefined
});

  function xAxisFormatter(val){
      return JSC.formatDate(new Date(2020,val-1,1),'MMM');
  }


</script>
	</body>
</html>