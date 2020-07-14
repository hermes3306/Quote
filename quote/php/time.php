<?php
    $chartdata = "";
    $db     =       new SQLite3($dbfile);
	$sql	= "select name,day,cr_date as d,cr_time as t from quote where cr_date = date()";

    $res = $db->query($sql);

    while ($row = $res->fetchArray()) {
		//$d = $row['d'];
		//$d = str_replace("-",",",$d);

		$t = $row['t'];
		$t = str_replace(":",",",$t);

		$df = "0,0,0," . $t;
		//$df = $d . "," . $t;
		//$df = str_replace(",0",",",$df);


        $chartdata = $chartdata .  "['" . $row['name'] . "', ";
        $chartdata = $chartdata .  "'" . $row['day'] . "', ";
        $chartdata = $chartdata .  "new Date(" . $df  . "),";
        $chartdata = $chartdata .  "new Date(" . $df  . ") ], \n";
    }

    $db->close();
	/* echo nl2br($chartdata); */
	/* echo $chartdata; */
?>



<html>
  <head>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  google.charts.load("current", {packages:["timeline"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {

    var container = document.getElementById('example5.1');
    var chart = new google.visualization.Timeline(container);
    var dataTable = new google.visualization.DataTable();
    dataTable.addColumn({ type: 'string', id: 'Name' });
    dataTable.addColumn({ type: 'string', id: 'Day' });
    dataTable.addColumn({ type: 'date', id: 'Start' });
    dataTable.addColumn({ type: 'date', id: 'End' });
    dataTable.addRows([

<?php echo $chartdata; ?>

	]);

    var options = {
      timeline: { colorByRowLabel: true }
    };

    chart.draw(dataTable, options);
  }

</script>
</head>

<body>
<?php include ('menu.php'); ?>


<div id="example5.1" style="width: 900; height: 500px;"></div>

</body>
</html>
