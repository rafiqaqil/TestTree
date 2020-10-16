<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Step Line DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->sqlStatement = 'SELECT * FROM Employees';
$de->dataFields = 'name=name,yAxis=salary';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 740px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get a data series.
Learn how to:

  - Query a MySQL database using PHP.
*/
// JS
var chart = new JSC.Chart('chartDiv', {
	title_label_text: 'Stepline sample',
	type: 'line step',
	legend_visible: false,
	defaultSeries: {
		type: 'line step',
		defaultPoint: {
			tooltip: '%name: <b>%yValue</b><br/>%percentOfSeries% of total Salaries',
			marker: {
				fill: 'white',
				outline: {width: 2, color: 'darken'}
			}
		},
		firstPoint: {
			marker_fill: 'complement',
			label: {visible: true, verticalAlign: 'top'}
		},
		lastPoint: {
			marker_fill: 'complement',
			label_visible: true
		}

	},
	xAxis: {
		crosshair_enabled: true,
		label_text: 'Employees'
	},
	yAxis: {		label_text: 'Salary',		formatString: 'c'	},
	toolbar_visible: true,
	series: getDBData()
});

function getDBData(){
	var php_var = <?php echo json_encode($series) ?>;
	return php_var ? JSON.parse(php_var) : undefined;
}


</script>
	</body>
</html>