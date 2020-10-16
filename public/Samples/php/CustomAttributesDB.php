<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Custom Attributes DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->addParameter("Aida");
$de->addParameter("George");
$de->addParameter("Joe");
$de->addParameter("David");
$de->sqlStatement = 'SELECT id,name,salary,Location,phone,Picture FROM Employees where name =? or name =? or  name =? or name =?';
$de->dataFields = 'xAxis=name,yAxis=id,Location=location,phone=phone,Picture=img';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">.infoDiv{
      vertical-align: top;
      top: -110px;
      position:relative;
      }
  .infoTable {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 13px;
      width: 220px;
      margin-top: 40px;
      padding: 0px;
      vertical-align: top;
      }
  .infoTable th {
      background-color: #E0E0E0;
      font-weight: bold;
      padding: 5px;
      border:0
      }
  .infoTable td { padding: 5px; border-style: none;}
  .infoTable .altRow { background-color: #F9F9F9;border-style:  none;}
  .iTblMCol { text-align: center;}</style>
	</head>
	<body>
	<table>
<tr>
<td>
<div id="chartDiv" style="width: 656px; height: 400px;">
	</div>
	</td>
	<td >
	<div id="side" class="infoDiv">
	<table id="sideTable" cellspacing="0" class="infoTable">
	<tr>
	<th>Rep</th>
	<th class="iTblMCol">Carats Sold</th>
<th>Value </th>
</tr>
</table>
</div>
<div id="div2" class="infoDiv" >

	</div>
	</td>
	</tr>
	</table>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get additional data attributes.
Learn how to:

  - Query a MySQL database using PHP.
  - Get custom data attributes from a MySQL Database.
*/
// JS


var clickableCol='#222222',
	php_var = <?php echo json_encode($series) ?>,
    valPerCarat = 11875,
    htmTemplate = '<table cellspacing="0" border="4" bordercolorlight="%color" bordercolordark="%color" bordercolor="%color" class="infoTable"><tr><th style="background-color: %color;"><img height="64" src="../images/%img" width="64"></th><th style="background-color: %color;">%name<br />%location</th></tr><tr><td>Contact</td><td>%phone</td></tr><tr class="altRow"><td>Carats</td><td>%yValue ct</td></tr><tr><td>Sales</td><td>{%yValue*'+valPerCarat+':c}</td></tr><tr class="altRow"><td>Percent</td><td>{%percentOfTotal:n1}%</td></tr></table>',
    sideTableRow = '<tr><td>%name</td><td class="iTblMCol">%yValue ct</td><td>{%yValue*'+valPerCarat+':c}</td></tr>',
	chart = new JSC.Chart('chartDiv',{
  toolbar_visible: false,
  title_label: {
    text: 'Diamond sales in carats. | Total: %sum ct  | Average carats per Rep: {%average:n2} ct'
  },
  defaultSeries: { type: 'column', palette: 'default'  },
  defaultTooltip_enabled: false,
  defaultPoint: {
    states_hover: {outline: {  width: 5} },
    label: {
      style_fontSize: 11,
      align: 'center',
      text: '%yValue ct <br/>{%yValue*11875:c}<br/> %location',
      color: clickableCol
    },
    events_mouseOver: pointEvent
  },
  legend: {
    position: 'inside left top',
    fill: ['rgba(255,255,255,.51)',false ],
    defaultEntry: {
      text: '<b>Out of %pointCount %name</b>  <br/>  Top Rep: <b>%maxPointName</b> (%max ct)   <br/>  Worse: <b>%minPointName</b> (%min ct)',
      style_color: clickableCol,
      iconWidth: 1
    }
  },
  defaultAxis: {
    defaultTick: {label_style_fontSize: '14px' },
    label_style_fontSize: '17px'
  },
  yAxis: [
    {
      id: 'mainY',
      label: {  text: 'Diamond carats'},
      defaultTick_label: {  text: '%value ct',  color: clickableCol}
    },
    {
      scale_syncWith: 'mainY',
      id: 'rightY',
      orientation: 'right',
      label: {  text: 'Value (USD)'},
      defaultTick_label: {  text: '{%value*11875:c}'}
    }
  ],
  series: php_var ? JSON.parse(php_var) : undefined
}, populateTable);

var div2Element = document.getElementById('div2');
div2Element.style.display = 'none';

function pointEvent(e) {
	var col, result;
	col = this.replaceTokens('%color').replace('#', '');
	result = this.replaceTokens(htmTemplate.replace(/%color/g, '#' + col));
	document.getElementById('side').style.display = 'none';
	div2Element.innerHTML = result;
	div2Element.style.display = 'block';
}

function populateTable() {
	var html = this.series().points().map(function (point) {		return point.replaceTokens(sideTableRow);	});
	document.querySelectorAll('#sideTable tbody')[0].innerHTML += html.join('');
}


</script>
	</body>
</html>