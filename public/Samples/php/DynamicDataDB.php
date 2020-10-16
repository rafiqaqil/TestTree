<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Dynamic Data DB | JSCharting</title>
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
	<div style="width: 645px; margin: 0px auto;">
	<table style="width: 640px">
		<tr>
			<td colspan="2" style="height: 400px">
				<div id="chartDiv" style="width: 635px; height: 400px"></div>
			</td>
		</tr>
		<tr>
		<td style="width: 400px">
			<div id="chartDiv2" style="width: 395px; height: 350px"></div>
		</td>
		<td valign="top"><br/><br/><br/>
			<div id="grid"></div>
		</td>
		</tr>
	</table>
</div>
	
<script type="text/javascript">
/*
Query a Database using PHP to add a sum series to a separate chart.
Learn how to:

  - Sum numeric columns using MySQL database.
  - Group result from a MySQL database based on a data column.
  - Get multiple series from a MySQL Database.
*/
// JS

var chart2,
	chartConfig = {
		defaultSeries_type: 'column',
		legend_visible: false,
		title_label_text: 'Original Database Data',
		defaultPoint_tooltip: 'Q%name %Yvalue<br/>%percentOfSeries% of %seriesName',
		yAxis_formatString: 'c',
		xAxis: {
			label_text: 'Quarter',
			defaultTick_label_text: 'Q %value'
		}
	};


var entryTemplate='<tr><td style="width: 77px;">%name</td><td>%yValue</td></tr>',
	tableTemplate='	<table style="width: 100%"><tr><td style="width: 77px; background-color: #E9E9E9"><strong>Quarter</strong></td><td style="background-color: #E9E9E9"><strong>Value</strong></td></tr>%entries%</table>';

var php_var = <?php echo json_encode($series) ?>;



if(php_var)
{

    var php_json = JSON.parse(php_var);
	chartConfig.series = php_json;

    // Generate the chart and pass a callback for when the chart is rendered.
    var chart = new JSC.Chart('chartDiv', chartConfig, makeSecondChart);
}
function makeSecondChart() {
	var seriesSum = [{}];
	seriesSum[0].points = [];

	this.series().each(function (ser, i) {
		/* Add series sums as a new series. Also, include the original series ID as attributes for each point so it can be used to build the table on hover.*/
		seriesSum[0].points.push({
			name: ser.name,
			y: Math.round(ser.tokenValue('%sum')),
			attributes: {parentID: ser.id}
		})
	});
	//Create the second chart.
	chart2 = new JSC.Chart('chartDiv2', {
		defaultSeries: {type: 'pie', shape_size: '65%'},
		title_label_text: 'Dynamic sums',
		legend_visible: false,
		xAxis_label_text: 'Days',
		yAxis_formatString: 'c',
		defaultPoint: {
			label_text: '<b>%name</b> <br/>%yValue - {%percentOfTotal:n1}%',
			tooltip: tooltipFormatter,
			events_mouseOver: hoverEvent
		},
		annotations: [{
			position: 'inside', margin: 1,
			label_text: 'Generated automatically from above data. Hover a pie slice to get details from above chart.'
		}],
		series: seriesSum
	});

}
function hoverEvent(ev) {

	var i, parentId = this.options('attributes.parentID'),
		tmpHtm = chart.series(parentId).points().map(function (point) {			return point.replaceTokens(entryTemplate);		}).join('');

	var gridElement = document.getElementById('grid');
	gridElement.innerHTML = tableTemplate.replace('%entries%', tmpHtm);
}
function tooltipFormatter(point) {
	var txt = '<b>%name</b> %yValue<br/>{%percentOfTotal:n1}% of Total<br/>Per Quarter:<br/>',
		parentId = point.options('attributes.parentID');

	txt += chart.series(parentId).points().map(function (p) {
		return p.replaceTokens('<b>%name</b> %yValue<br/>');
	}).join('');

	return txt;
}


</script>
	</body>
</html>