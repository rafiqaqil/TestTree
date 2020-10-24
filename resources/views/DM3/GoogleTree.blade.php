<!DOCTYPE html>
<meta charset="UTF-8">

<body>
    <h1>Total Members {{ $all }}</h1>
    <h1>Levels {{ $levels->depth }}</h1>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <div id="chart_div"></div>


<!-- load the d3.js library --> 
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
            
          @foreach($chart as $c)
               [{'v':'{{ $c->id }}', 'f':'{{ $c->name }} <br> \n\
                                Balance:{{ $c->balance*0.8 }}<br> \n\
                                Rentry:{{ $c->balance*.2 }}<div style="color:red; font-style:italic"></div>'},'{{ $c->parent_id }}', ''],
          
          
          @endforeach
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true});
      }
</script>
</body>
