<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Area Legend Pie DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<script type="text/javascript" src="../../jsc/modules/types.js"></script>
<?php
$de = new DataEngine();
$de->sqlStatement = 'SELECT DatePeriod,Purchases,Taxes,Supplies,Rent FROM AreaData';
$de->dataFields = 'xAxis=DatePeriod,yAxis=Purchases,yAxis=Taxes,yAxis=Supplies,yAxis=Rent';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 840px; height: 494px;margin: 0px auto;">
</div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get multiple series.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS
var sumSeries = {
	name: 'Summary', type: 'pie',
	defaultPoint: {
		tooltip: '%name <b>%yValue</b><br/>{%percentOfSeries:n1}% of Total',
		label_text: '%name <br/>[%yValue | {%percentOfSeries:n1}%]',
		label_line_length: 3,
		label_style: {fontSize: 12}
	},
	cursor: 'pointer',
	shape: {center: '200,100', size: 110},
	points: [
		{name: 'Purchases', y: 1507.00, color: '#E51E19', id: 'purchases'},
		{name: 'Taxes', y: 1320.90, color: '#FC7529'},
		{name: 'Supplies', y: 1312.10, color: '#F9F23D'},
		{name: 'Rent', y: 1149.90, color: '#8DEA55'}

	]
};
var chart,php_var,chartJson={
  title_label: {
    style_fontSize: 16,
    text: 'XYZ Inc 2014 Cost Chart. Total Costs (%sum)'
  },
  defaultSeries: { type: 'area', opacity: 0.85  },
  palette: 'fiveColor32',
  defaultAxis: {
    defaultTick_label_style_fontSize: '14px',
    label_style_fontSize: '16px'
  },
  yAxis: {
    scale_type: 'stacked',
    label: {text: 'Cost (USD)' },
    formatString: 'c'
  },
  defaultPoint: {
    tooltip: '%seriesName <b>%yValue</b><br/>{%percentOfGroup:n1}% of this month\'s cost<br/>{%percentOfTotal:n1}% of 2014 cost',
    events_click: toggleSer,
    label_style_fontSize: 12,
    marker: {
      type: 'circle',
      fill: 'white',
      outline: {  width: 2,  color: 'currentColor'}
    }
  },
  annotations: [
    {
      position: 'inside top left',
      label_text: 'Click the pie slices to toggle series visibility.'
    }
  ],
  xAxis: {
    label_text: '2014',
    originTick_enabled: false,
    scale_interval: 1,
    defaultTick_label_text: xAxisFormatter
  },
  legend_visible: false
},jSer;


if(php_var = <?php echo json_encode($series) ?>)
{
  jSer=chartJson.series =JSON.parse(php_var);
  jSer[0].id = 'pur';
  jSer[1].id = 'tax';
  jSer[2].id = 'sup';
  jSer[3].id = 'ren';

  jSer.push(sumSeries);
}

chart = new JSC.Chart('chartDiv', chartJson);

function xAxisFormatter(val) {
	return JSC.formatDate(new Date(2020, val - 1, 1), 'MMM');
}

function toggleSer(e) {
	if (this.series.name === 'Summary') {
		chart.series(this.name).visible();
		this.options({exploded: !this.options('exploded')})
	}
}


</script>
	</body>
</html>