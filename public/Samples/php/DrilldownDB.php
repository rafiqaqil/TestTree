<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Drilldown DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>
<script type="text/javascript" src="../../jsc/jquery-latest.min.js"></script>
<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php

?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 640px; height: 350px;margin: 0px auto;">
</div>
	
<script type="text/javascript">
/*
Query a Database using a PHP script page to serve the drilldown data.
Learn how to:

  - Use the PHP DataEngine dateGrouping feature with MySql.
  - Get multiple series from a MySql Database.
  - Use a PHP script file to load data dynamically from MySql with Ajax.
  - Drilldown chart using MySql and PHP.
*/
// JS
var drillLevels = ["Years","Months","Days","Hours"];
var curLevel = 0;
var startDate;
var drillParamsStack=[];
var lastDrillParams=[];
var thisDrillParams=[];
var nowShowing='Years';
var palette;
var chart;
var uiBtn;

JSC.ready().then(function(){
	palette = JSC.getPalette('default');
	getData('Years','2013');
});

function drillUp() {
	curLevel--;
	drillParamsStack.pop();
	lastDrillParams = drillParamsStack.pop();
	getData(lastDrillParams[0], lastDrillParams[1]);
}

function updateChart(json) {
	updateDrillUpButton();
	if (!chart) {
		chart = new JSC.Chart('chartDiv',{
			type: 'column',
			legend_visible: false,
			defaultSeries_type: 'column',
			xAxis_scale_interval: 1,
			yAxis_formatString: 'c',
			yAxis_label_text:'Sales',

			toolbar_items:{
				export_visible:false,
				'drillStep':{
					icon_name:'system/default/zoom/arrow-left',
					label_text:'',
					visible: false,
					id:'drillBtn',
					events_click:drillUp
				}
			},
			annotations:[{
				id:'sumAnn',
				label_text:'Total: %sum',
				outline_width:0,
				position:'inside right top'
			}],
			defaultPoint_events_click: pointClick,
			series: json.series,
			xAxis: {id: 'xAxis', label_text: 'Year'},
			title: {label_text: 'Years 2013 to 2014'}
		},function(c){			uiBtn = c.toolbar().items('drillBtn');		});

	}
	else {
		chart.options({title_label_text: nowShowing});
		chart.axes('x').options({label_text: json.xAxis_label_text || drillLevels[curLevel]});
		chart.series(0).options(json.series[0]);

	}
	updateDrillUpButton();
}
function pointClick(e) {
	// If clicked by a poit
	if (e) {
		switch (drillLevels[curLevel]) {
			case "Years":
				getData(drillLevels[++curLevel], this.name);
				break;
			case "Months":

				getData(drillLevels[++curLevel], this.replaceTokens(startDate.getFullYear() + '-%name-01'));
				break;
			case "Days":
				getData(drillLevels[++curLevel], this.replaceTokens(startDate.getFullYear() + '-' + (startDate.getMonth() + 1) + '-%xValue'));
				break;
			case "hours":
				drillUp();
				break;
			default:
				break;
		}
	}
}

function updateDrillUpButton() {
	if (!uiBtn) {		return;	}
	switch (drillLevels[curLevel]) {
		case "Years":
			uiBtn.options({visible: false});
			break;
		case "Months":
			uiBtn.options({label_text: 'Years', visible: true});
			break;
		case "Days":
			uiBtn.options({label_text: JSC.formatDate(startDate, 'yyyy')});
			break;
		case "Hours":
			uiBtn.options({label_text: JSC.formatDate(startDate, 'MMMM yyyy')});
			break;
		default:
			break;
	}
}
function processChart(data, dateGrouping, fromDate) {
	data.series[0].points = JSC.parsePoints(data.series[0].points);
	var json = data;
	var config = data;
	var point;

	if(!json.series){		return;	}
	var points = json.series[0].points;
	var year = parseInt(fromDate);
	json.series[0].name = "Sales";
	if (typeof points === 'string') {
		points = json.series[0].points = eval('(' + points + ')');
	}

	if (dateGrouping == 'Years') {
		startDate = new Date(year, 0, 1, 0, 0, 0, 0);
		nowShowing = 'Years 2013 to 2014';
		points.forEach(function(p,i){			p.color=palette[i];		});

		config.xAxis_label_text = 'Year';
	}
	else if (dateGrouping == 'Months') {
		nowShowing = 'Sales for ' + year;
		startDate = new Date(year, 0, 1, 0, 0, 0, 0);

		config.xAxis_label_text = 'Month';
		for (var m = 0; m < points.length; m++) {
			point = points[m];
			var objDate = new Date(point.name + "/1/" + startDate.getFullYear());
			point.x = JSC.formatDate(objDate, 'MMM');
			delete point.name;
			point.color = palette[year - 2013];
		}
	}
	else if (dateGrouping == 'Days') {
		var dateParts = fromDate.split('-');
		var monthsAbbriviation =['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

		for (var m = 0; m < points.length; m++) {
			point = points[m];
			point.color = palette[year - 2013];
		}
		startDate = new Date(year, monthsAbbriviation.indexOf(dateParts[1]), 1, 0, 0, 0, 0);
		nowShowing = 'Sales for ' + JSC.formatDate(startDate, 'MMMM yyyy');

		config.xAxis_label_text = 'Day';
	}
	else if (dateGrouping == 'Hours') {
		var fromDate2 = fromDate.split("-");
		startDate = new Date(parseInt(fromDate2[0]), parseInt(fromDate2[1]) - 1, parseInt(fromDate2[2]), 0, 0, 0, 0);
		nowShowing = 'Sales for ' + JSC.formatDate(startDate, 'd');

		points.forEach(function(p){
			JSC.merge(p,{name:p.name+'',color:palette[year - 2013]})
		});
		config.xAxis_label_text = 'Hour';
	}
	config.title_label_text = nowShowing;
	updateChart(config);
}
function getData(dateGrouping, fromDate) {
	if (!fromDate) {fromDate="2013";}
	fromDate = fromDate.replace(/[^\x00-\x7F]/g, "") ;
	drillParamsStack.push([dateGrouping, fromDate])
	lastDrillParams = thisDrillParams;
	thisDrillParams = [dateGrouping, fromDate];
	if (!dateGrouping) {		dateGrouping = "Years";	}

	JSC.fetch('DrilldownDataDB.php?dategrouping=' + dateGrouping + '&startDate=' + fromDate).then(function(response){		return response.json();	}).then(function(json){		processChart(json, dateGrouping, fromDate);	})	.catch(function(ex) {		console.error(ex)	});

}


</script>
	</body>
</html>