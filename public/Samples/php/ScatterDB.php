<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Scatter DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->sqlStatement = 'SELECT Experience,salary,name As EmployeeName FROM Employees';
$de->dataFields = 'xAxis=Experience,yAxis=salary,EmployeeName';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width:650px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a Database using PHP to get multiple series split by another field in the database.
Learn how to:

  - Query a database using PHP.
  - Get point tooltips from a database.
  - Use the SplitBy feature of DataEngine to split MySQL database data into multiple series based on a data field.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
	chart = new JSC.Chart('chartDiv', {
		title_label_text: 'Scatter sample',
		legend_visible: false,
		defaultSeries_type: 'marker',
		toolbar_visible: true,
		xAxis:{
			scale_interval: 5,
			label_text: 'Years of Experience',
		},
		yAxis:{
			formatString: 'c',
			label_text: 'Income (USD)',
		},
		defaultPoint_tooltip: '%EmployeeName earns %yValue<br/> with %xValue years experience',
		series: getDBData()
	});

	function getDBData() {
		return php_var ? JSON.parse(php_var) : undefined;
	}


</script>
	</body>
</html>