<?php include('common.php'); ?>

<html>
  <head>

<?php
    $chartdata = "";
	$chartarr  = array();
    $db     =       new SQLite3($dbfile);
	$sql 	= "select name n, subject s, count(subject) c from quote group by name,subject";
    $res = $db->query($sql);
    while ($row = $res->fetchArray()) {
        $chartdata = $chartdata .  "['" . $row['s'] . "', ";
        $chartdata = $chartdata .  $row[c] . " ], \n";

		$chartarr[$row['n']] = $chartarr[$row['n']] .  "['" . $row['s'] . "', ";
		$chartarr[$row['n']] = $chartarr[$row['n']] . $row[c] . " ], \n"; 

    }
    $db->close();


	foreach($chartarr as $k => $v) {
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Subject', '# of'],
<?php
	echo $chartarr[$k];
?>
        ]);
        var options = {
          title: '<?php echo $pname?>'
        };
        var chart = new google.visualization.PieChart(document.getElementById('<?php echo $k; ?>'));
        chart.draw(data, options);
      }
    </script>
<?php
	} /* end of for */
?>

  </head>
<body>
<?php include ('menu.php'); ?>

<?php
	foreach($chartarr as $k => $v) {
?>
		<div id="<?php echo $k; ?>" style="width: 900; height: 500px;">
			<?php echo $k; ?>
		</div>
<?php
	}
?>

</body>
</html>
