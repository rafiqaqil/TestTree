<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Spline DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->sqlStatement = 'SELECT DatePeriod,Purchases,Taxes,Supplies,Rent FROM AreaData';
$de->dataFields = 'xAxis=DatePeriod,yAxis=Purchases,yAxis=Taxes,yAxis=Supplies,yAxis=Rent';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get multiple spline series.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS
var chart = new JSC.Chart('chartDiv', {
	title_label_text: ' Costs (Last 12 Months) ',
	legend_position: 'inside right bottom',

	defaultSeries_type: 'spline',
	yAxis: {		formatString: 'c',		label_text: 'Costs'	},
	xAxis: {
		crosshair_enabled: true,
		scale_interval: 1,
		defaultTick_label_text: xAxisFormatter,
		label_text: 'Month'
	},
	series: getDBData()
});

function getDBData(){
	var php_var = <?php echo json_encode($series) ?>;
	return php_var ? JSON.parse(php_var) : undefined;
}

function xAxisFormatter(val) {
	return JSC.formatDate(new Date(2014, val - 1, 1), 'MMM');
}


</script>
	</body>
</html>