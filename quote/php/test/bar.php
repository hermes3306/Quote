<html>
  <head>
  	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['Name', 'Days',],
        ['Britni', 10],
        ['Hawazin', 12],
        ['Joonho', 19],
        ['Kat.', 11],
        ['Maria', 10]
      ]);

      var options = {
        title: 'Day 21',
        chartArea: {width: '50%'},
        hAxis: {
          title: '# of Days',
          minValue: 0
        },
        vAxis: {
          title: 'Name'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }

    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
