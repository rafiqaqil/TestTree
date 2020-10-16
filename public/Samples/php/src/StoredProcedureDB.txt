<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Stored Procedure DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$startDate = new DateTime('2014-1-1');
$endDate = new DateTime('2014-12-31 23:59:59');
$title = 'Orders From ' . date_format($startDate, 'm/d/Y') . ' to ' . date_format($endDate, 'm/d/Y') . ',  Total : %sum';

$de = new DataEngine();
//spSalesDateGroup stored procedure should be defined in your database with the following 3 parameters
$de->storedProcedure = 'spSalesDateGroup';
$de->addParameter($startDate);
$de->addParameter($endDate);
$de->addParameter("MONTH");
$de->dataFields = 'xAxis=OrderDate,yAxis=Sales'; //default setting
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a MySQL Database using stored procedure in PHP to get data.
Learn how to:

  - Select MySql database data based on a date range.
  - Group MySql database results based on month number of dates.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
    php_title = <?php echo json_encode($title) ?>,
    chart = new JSC.Chart('chartDiv', {

        palette: ['#30dd83'],
        title_label_text: php_title,
        legend_visible: false,
        defaultSeries_type: 'column',
        defaultPoint_tooltip: '{%percentOfTotal:n1}% of 2014 %seriesName',
        yAxis: {label_text: 'Total Sales  (USD)',formatString: 'c'  },
        xAxis: {
            formatString: 'MMM',
            label_text: 'Month',
            scale: {interval: {unit: 'month', multiplier: 1}, type: 'time'}
        },
        series: php_var ? JSON.parse(php_var) : undefined
    });

function xAxisFormatter(val) {
    return JSC.formatDate(new Date(2014, val - 1, 1), 'MMM');
}


</script>
	</body>
</html>