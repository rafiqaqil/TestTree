<?php
//The included Includes/DataEngine.php contains
//functions to help easily embed the charts and connect to a database.
include("Includes/DataEngine.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Zooming XYDB | JSCharting</title>
	<meta http-equiv="content-type" content="text-html; charset=utf-8"/>

<script type="text/javascript" src="../../jsc/jscharting.js"></script>
	
<?php
$de = new DataEngine();
$de->sqlStatement = 'SELECT * FROM WorldPopulation';
$de->dataFields = 'xAxis=Year,yAxis=Population,zAxis=AnnualGrowth';
$series = $de->getSeries();
?>

	      <link rel="stylesheet" type="text/css" href="../css/default.css">
		  <style type="text/css">/*CSS*/</style>
	</head>
	<body>
	<div id="chartDiv" style="max-width: 740px; height: 400px;margin: 0px auto;"></div>
	
<script type="text/javascript">
/*
Query a MySQL Database using PHP to get a data series x, y, and z values.
Learn how to:

  - Query a MySQL database using PHP.
*/
// JS
var php_var = <?php echo json_encode($series) ?>,
    chart = new JSC.Chart('chartDiv', {
        title: {label: {text: "World Population 1950-1985"}},
        annotations: [
            {
                position: "inside top",
                label_text: "Click-Drag the chart area to zoom."
            }
        ],
        axisToZoom: "xy",
        legend_visible: false,
        defaultSeries: {type: "bubble",size_max: 30  },
        yAxis: {
            label_text: "World Population",
            scale_zoomLimit: 1000000
        },
        defaultAxis: {label_style_fontSize: '15px'  },
        xAxis: {
            label_text: "Years",
            formatString: 'd0',
            scale_zoomLimit: 1

        },
        toolbar_visible: true,
        series: php_var ? JSON.parse(php_var) : undefined
    });


</script>
	</body>
</html>