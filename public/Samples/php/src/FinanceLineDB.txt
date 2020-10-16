<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Finance Line DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->addParameter(new DateTime('2013-03-01'));
$de->addParameter(new DateTime('2013-05-01'));
$de->sqlStatement = 'SELECT TransDate, HighPrice AS MSFT FROM MSFT WHERE TransDate >= ? AND TransDate <= ? ORDER BY TransDate';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get a single series using date ranges.
Learn how to:

  - Select MySql database data based on a date range.
  - Sort MySql database results by dates.
*/
// JS
var chart = new JSC.Chart('chartDiv', {
  legend_visible: false,
  defaultSeries_type: 'line',
  xAxis: {
    formatString: 'd',
    scale_type: 'time',
    crosshair_enabled: true
  },
  yAxis_formatString: 'C',
  defaultPoint_marker_visible: false,
  series: getDBData()
});

function getDBData(){
	var php_var = <?php echo json_encode($series) ?>;
	return php_var ? JSON.parse(php_var) : undefined;
}


</script>
	</body>
</html>