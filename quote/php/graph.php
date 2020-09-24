<?php include('common.php'); ?>
<?php
	$chartdata = "";
	$db     =       new SQLite3($dbfile);
	$res = $db->query('SELECT name, max(day) as d FROM quote group by name');
	while ($row = $res->fetchArray()) {
		$chartdata = $chartdata .  "['" . $row['name'] . "'," . $row['d'] . "],";
	}
	$db->close();
?>

<html>
  <head>
  	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
       ['Name', 'Days',],
<?php
	echo $chartdata;
?>
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

<?php include ('menu.php'); ?> 
    <div id="chart_div" style="width: 450; height: 250px;"></div>
  </body>
</html>
