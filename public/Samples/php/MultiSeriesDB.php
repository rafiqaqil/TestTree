<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Multi Series DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->addParameter(new DateTime('2014-1-1'));
$de->addParameter(new DateTime('2014-12-31 23:59:59'));
$de->sqlStatement = 'SELECT MONTH(OrderDate) AS Month, SUM(1) AS Sales FROM Orders
WHERE OrderDate >=? And OrderDate <=? GROUP BY MONTH(OrderDate)ORDER BY MONTH(OrderDate);';
$series = $de->getSeries();

//Multiple series can be generated from different sqlStatement
$de->sqlStatement = 'SELECT DatePeriod,Purchases As Costs FROM AreaData';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 640px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get multiple series.
Learn how to:

  - Format MySql database Dates as month numbers.
  - Select MySql database data based on a date range.
  - Group MySql database results based on month number of dates.
  - Sort MySql database results by dates.
  - Use multiple SQL statements to get multiple series from a MySQL database.
*/
// JS

var php_var = <?php echo json_encode($series) ?>,
    chart = new JSC.Chart('chartDiv', {
        legend_position: 'inside left top',
        defaultSeries_type: 'line',
        toolbar_visible: false,
        yAxis_formatString: 'c',
        xAxis: {
            scale: {interval: 1},
            defaultTick_label_text: xAxisFormatter
        },
        defaultPoint_tooltip: '<b>%yValue</b><br/>%percentOfSeries% of %seriesName',
        title_label_text: 'Multi series from different tables',
        series: php_var && JSON.parse(php_var)

    });

    function xAxisFormatter(val) {
        return JSC.formatDate(new Date(2014, val - 1, 1), 'MMM');
    }


</script>
	</body>
</html>