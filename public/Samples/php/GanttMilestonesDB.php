<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Gantt Milestones DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$title = 'Project Beta';
$de = new DataEngine();
$de->sqlStatement = 'SELECT * FROM GanttSample';
$de->dataFields = 'ganttname=Job,ganttstartdate=StartDate,ganttenddate=EndDate,splitby=Category'; //splitby must be set for Gantt chart
$de->compactPointFormat = FALSE;
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 740px; height: 400px;margin: 0px auto;">
</div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get a Gantt chart.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS

var php_var = <?php echo json_encode($series) ?>,
	php_title = <?php echo json_encode($title) ?>,
	chart = new JSC.Chart('chartDiv', {

		/*Typical Gantt setup. Horizontal columns by default.*/
		type: 'horizontal column',
		/*Make columns overlap.*/
		zAxisScaleType: 'stacked',
		/*Time Y Axis.*/
		yAxis_scale_type: 'time',
		legend_position: 'bottom',

		title_label_text: php_title,

		defaultSeries: {
			defaultPoint: {
				legendEntry: {
					value: '{days(%max-%min):number n0} days'
				},
				tooltip: '<b>%name</b> <br/>%low - %high<br/>{days(%high-%low)} days',
				marker_type: 'diamond'
			},
			firstPoint: {
				xAxisTick: {label: {text: '<b>%name</b>', style: {fontSize: '14px'}}},
				outline: {color: 'darkenMore', width: 3}
			}
		},
		yAxis: {
			markers: [

				{
					value: 1492664400000 /*'4/20/2017'*/, color: 'red',
					label_text: 'Now'
				},
				{
					value: [1488348000000 /*'3/1/2017'*/, 1490850000000 /*'3/30/2017'*/], color: ['orange', .5],
					label_text: 'Vacation'
				}
			]
		},
		series: getDBData()
	});

function getDBData() {
	var series = php_var ? JSON.parse(php_var) : undefined;
	series.push(getRangeOverlaySeries(series, '3/1/2017', '3/30/2017'));
	return series;
}

/**
 * Automatically generate a series (slack time) that overlaps data points in the specified series for the given date ranges.
 * @param series
 * @param date1
 * @param date2
 * @returns {{name: string, defaultPoint: {color: string, tooltip: string}, points: Array}}
 */
function getRangeOverlaySeries(series, date1, date2) {

	date1 = normalizeValue(date1);
	date2 = normalizeValue(date2);
	var newSer = {
		name: 'Slack',
		defaultPoint: {color: 'white', tooltip: '%name (slack time)'},
		points: []
	}, y1, y2,
	points = newSer.points;
	series.forEach(function(ser){
		ser.points.forEach(function(point){
			if (point.y.length) {
				y1 = normalizeValue(point.y[0]);
				y2 = normalizeValue(point.y[1]);
				if (date2 > y1 && date1 < y2) {
					points.push({name: point.name, y: [date1 > y1 ? date1 : y1, date2 < y2 ? date2 : y2]})
				}
			}
		})
	});
	return newSer;
	function normalizeValue(v) {		return (typeof v === 'string')?Date.parse(v):v;	}
}


</script>
	</body>
</html>