<?php include('common.php'); ?>
<?php
	$pname = $_GET['name'];
    $chartdata = "";
    $db     =       new SQLite3($dbfile);
	$sql 	= "select subject s, count(subject) c from quote group by name,subject having name like '" . $pname . "'";

    $res = $db->query($sql);

    while ($row = $res->fetchArray()) {

        $chartdata = $chartdata .  "['" . $row['s'] . "', ";
        $chartdata = $chartdata .  $row[c] . " ], \n";
    }

    $db->close();
	/* echo nl2br($chartdata); */
	/* echo $chartdata; */
?>



<html>
  <head>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Subject', '# of'],

<?php
	echo $chartdata;
?>
        ]);

        var options = {
          title: '<?php echo $pname?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>

<body>
<?php include ('menu.php'); ?>

<div id="piechart" style="width: 900; height: 500px;"></div>

</body>
</html>
