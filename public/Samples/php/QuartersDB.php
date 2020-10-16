<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Quarters DB | JSCharting</title>
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
	<div id="chartDiv" style="max-width: 840px; height: 590px;margin: 0px auto;"></div>
</div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get series grouped by quarter.
Learn how to:

  - Sum numeric columns using MySQL database.
  - Group result from a MySQL database based on a data column.
  - Select MySql database data based on a column value range.
*/
// JS

var php_var = <?php echo json_encode($series) ?>,
	chart = new JSC.Chart('chartDiv', {

		defaultSeries: {type: 'column', opacity: 0.85},
		palette: 'fiveColor32',
		title_label_style_fontSize: '16px',
		legend_defaultEntrystyle_fontSize: '14px',
		defaultAxis: {
			label_style_fontSize: '16px',
			defaultTick_label_style_fontSize: '14px'
		},
		yAxis: {
			scale_type: 'stacked',
			formatString: 'c',
			label_text: 'Spent (USD)'
		},
		xAxis: {
			label_text: 'Quarter',
			defaultTick_label_text: 'Q %value'
		},
		legend: {

			layout: 'horizontal',
			position: 'inside left top'
		},
		defaultPoint_tooltip: '%seriesName <b>%yValue</b><br/>{%percentOfGroup:n1}% of this quarter\\\'s cost<br/>{%percentOfTotal:n1}% of 2019 cost',
		title_label_text: '2019 Spending',
		series: getDBData()
	});

	function getDBData() {
		return php_var ? JSON.parse(php_var) : undefined;
	}


</script>
	</body>
</html>