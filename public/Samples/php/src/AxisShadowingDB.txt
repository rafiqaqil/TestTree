<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Axis Shadowing DB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<script type="text/javascript" src="../../jsc/icons/weather/snowflake.js"></script>
<script type="text/javascript" src=" ../../jsc/icons/weather/sun.js"></script>
<?php
$de = new DataEngine();
  $de->sqlStatement = 'SELECT DatePeriod,AverageHigh,AverageLow FROM AreaData';
  $de->dataFields = 'xAxis=DatePeriod,yAxis=AverageHigh,yAxis=AverageLow';
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
Query a MySQL Database using PHP to get multiple series on different axes.
Learn how to:

  - Query a MySQL database using PHP.
  - Get multiple series from a MySQL Database.
*/
// JS

var php_var = <?php echo json_encode($series) ?>,
  chart = new JSC.Chart('chartDiv',{
  type: 'line spline',
  palette: [ 'crimson', '#03bbfb'  ],
  legend: {
    position: 'inside top left',
    template: '%icon %name'
  },
  title: {
    label: {
      text: 'Average Temperatures (Chicago)  |  Range %min°F–%max°F    Average: %average°F',
      style_fontSize: '16px'
    }
  },
  defaultAxis: { defaultTick_label_style_fontSize: '13px'  },
  yAxis: [
    {
      id: 'mainY',
      label_text: '(°F) Fahrenheit',
      defaultTick_label_text: '%value°F',
      defaultMarker: {
        legendEntry_visible: false,
        label_style_fontSize: 14
      },
      markers: [
        {
          value: [0,32 ],
          label_text: '<icon name=weather/snowflake size=15 verticalAlign=center margin_right=4> Freezing',
          color: ['#65affb',0.5 ]
        },
        {
          value: 72,
          label_text: '<icon name=weather/sun size=18 verticalAlign=center margin_right=4> Perfect (72°F)',
          line_width: 3,
          color: ['#fcc348',0.5 ]
        }
      ]
    },
    {
      scale_syncWith: 'mainY',
      orientation: 'right',
      formatString: 'n2',
      label_text: '(°C) Celcius',
      defaultTick_label_text: '{(%Value-32)*5/9:n1}°C'
    }
  ],
  xAxis: {
    crosshair_enabled: true,
    defaultTick_label: {text: xAxisFormatter },
    scale_interval: 1
  },
  defaultPoint: {
    tooltip: '%seriesName: <b>%yValue°F</b>  ({(%yValue-32)*5/9:n1}°C)',
    marker: {
      size: 9,
      type: 'circle',
      fill: 'white',
      outline_width: 2
    }
  },
  toolbar_visible: false,
  series: php_var ? JSON.parse(php_var) : undefined
});

  function xAxisFormatter(val){
      return JSC.formatDate(new Date(2020,val-1,1),'MMM');
  }


</script>
	</body>
</html>