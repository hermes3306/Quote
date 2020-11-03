<html><body>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>

<?php
echo "
<table border='0' align='left'>
<tr>
<td>Name</td>
<td>Last Day</td>
<td>Count</td>
<td>Remains</td>
<td>Hist</td>
</tr> ";

$db     =       new SQLite3($dbfile);

$res = $db->query('SELECT name, max(day) as d, count(day) as m, 21-max(day) as r  FROM quote group by name');
while ($row = $res->fetchArray()) {
                echo "<tr>	<td>{$row['name']}</td> 
			  	<td>{$row['d']}</td>
			  	<td>{$row['m']}</td>
				<td>{$row['r']}</td>
				<td><a href=hist.php?name={$row['name']}>view</a></td> </tr>";
}
$db->close();
echo "</table>
</body>
</html>";

?>
