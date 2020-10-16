<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Gantt DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->sqlStatement = 'SELECT * FROM GanttSample';
$de->dataFields = 'ganttname=Phase,ganttstartdate=StartDate,ganttenddate=EndDate,splitby=Category'; //splitby must be set for Gantt chart
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 640px; height: 400px;margin: 0px auto;">
</div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get a Gantt chart.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS

var chart = new JSC.Chart('chartDiv', {
  type: 'horizontal column',
  title_label_text: 'Simple Gantt Chart',
  zAxis_scale_type: 'stacked',
  yAxis: { scale_type: 'time'  },
  defaultSeries_firstPoint: { hatch: {style: 'light-upward-diagonal' }  },
  defaultPoint_opacity: 0.5,
  legend_visible: false,
  series: getDBData()
});

function getDBData(){
	var php_var = <?php echo json_encode($series) ?>;
	return php_var ? JSON.parse(php_var) : undefined;
}


</script>
	</body>
</html>