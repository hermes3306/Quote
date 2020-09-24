<html><body>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>

<?php 
echo "

<table border='0' align='left'>
<tr>
<td>Name</td>
<td>Time Zone</td>
<td>Detail</td>
<td>UTC</td>
<td>Date</td>
<td>Time</td>
</tr> ";

$db     =       new SQLite3($dbfile);

$res = $db->query('SELECT * FROM Tz');
while ($row = $res->fetchArray()) {
				$timezone   = $row['utc'];
				$cr_date	= gmdate("Y-m-j", time() + 3600*($timezone+date("I"))); 
				$cr_time	= gmdate("H:i:s", time() + 3600*($timezone+date("I"))); 

                echo "<tr>	<td>{$row['name']}</td> 
			  	<td>{$row['tz']}</td>
			  	<td>{$row['detail']}</td>
			  	<td>UTC{$row['utc']}</td>
			  	<td>{$cr_date}</td>
			  	<td>{$cr_time}</td><tr>";
}

$db->close();
echo "</table>


</body>
</html>";

?>

