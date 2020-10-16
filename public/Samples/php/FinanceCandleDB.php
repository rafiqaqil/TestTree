<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Finance Candle DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->addParameter(new DateTime('2014-01-01'));
$de->addParameter(new DateTime('2014-2-01'));
$de->sqlStatement = 'SELECT TransDate, HighPrice, LowPrice, OpenPrice, ClosePrice FROM MSFT WHERE TransDate >=? AND TransDate <=? ORDER BY TransDate';
$de->dataFields = 'xAxis=TransDate,High=HighPrice,Low=LowPrice,Open=OpenPrice,Close=ClosePrice';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get OHLC financial data on a CandleStick chart.
Learn how to:

  - Select MySql database data based on a date range.
  - Sort MySql database results by dates.
*/
// JS
var	php_var = <?php echo json_encode($series) ?>,
	chart = new JSC.Chart('chartDiv',{
  legend_visible: false,
  defaultSeries_type: 'candlestick',
  defaultPoint_tooltip: tooltip,
  yAxis_formatString: 'c',
  xAxis: { scale_type: 'time', crosshair_enabled: true  },
  series: getDBData()
});

function tooltip(point) {
	var color = point.options('close') > point.options('open') ? 'green' : 'red';
	return 'Change: <span style="color:' + color + '"><b>{%close-%open}</b></span><br>Open: %open<br/>High: %high<br/>Low: %low<br/>Close: %close'
}

function getDBData(){	return php_var ? JSON.parse(php_var) : undefined;}


</script>
	</body>
</html>