<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Months DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$startDate = new DateTime('2014-1-1');
$endDate = new DateTime('2014-6-30 23:59:59');
$title = 'Orders From ' . date_format($startDate, 'm/d/Y') . ' to ' . date_format($endDate, 'm/d/Y') . ',  Total Orders : %sum';
$de = new DataEngine();
$de->addParameter($startDate);
$de->addParameter($endDate);
$de->sqlStatement = 'SELECT MONTH(OrderDate) AS Month, SUM(1) AS Orders FROM Orders WHERE OrderDate >=? And OrderDate <=?
    GROUP BY MONTH(OrderDate)
    ORDER BY MONTH(OrderDate)';
    $series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get data grouped by months.
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
        legend_visible: false,
        defaultSeries_type: 'column',
        defaultPoint: {label_visible: true,  },
        xAxis: {
            label_text: 'Month', scale: {interval: 1},
            defaultTick: {label_text: xAxisFormatter}
        },
        yAxis: {label_text: 'Orders', defaultTick_enabled: false},
        series: php_var && JSON.parse(php_var)

    });

function xAxisFormatter(val) {
    return JSC.formatString(new Date(2014, val - 1, 1), 'MMM yyyy');
}


</script>
	</body>
</html>