<!DOCTYPE html>
<meta charset="UTF-8">

<body>
    <a></a?>
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
          @if($c->logs != 200 && $c->logs != 1200 && $c->logs != 0)
          [{'v':'{{ $c->id }}', 'f':'{{ $c->name }}  <br> Balance: {{$c->balance}}\n\
                            <br> Plan: {{$c->affiliate_type}} <br> Group-Sale: {{$c->logs}}\n\
                           <br> \n\
                               <div style="color:red; font-style:italic">-</div>'},'{{ $c->parent_id }}', ''],
            
            @else
                        [{'v':'{{ $c->id }}', 'f':'{{ $c->name }}  <br> Balance: {{$c->balance}}\n\
                            <br> Plan: {{$c->affiliate_type}} <br> \n\
                           <br> \n\
                               <div style="color:red; font-style:italic">-</div>'},'{{ $c->parent_id }}', ''],
                
            @endif
                               
    
          
          
          @endforeach
        ]);
         
         
         var i;
         for(i=2;i<{{$all-1}} ;i++){
             console.log("Hey");
             console.log(i);
          data.setRowProperty(i, 'style','width:150px;height:60px;background-color:#00FF00');
         } 
        //

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true,
                            'allowCollapse':true,
                             'size':'small',
        
        
        });
      }
</script>
</body>
