<html><body>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>

<?php
echo "
<table border='0' align='left'>
<tr>
<td>Name</td>
<td>Started</td>
<td>Last</td>
<td>Count</td>
<td>Hist</td>
</tr> ";

$db     =       new SQLite3($dbfile);

$res = $db->query('SELECT name, min(cr_date) min,  max(cr_date) as max, count(day) as c  FROM quote group by name');
while ($row = $res->fetchArray()) {
                echo "<tr>	<td>{$row['name']}</td> 
			  	<td>{$row['min']}</td>
			  	<td>{$row['max']}</td>
			  	<td>{$row['c']}</td>
				<td><a href=hist.php?name={$row['name']}>view</a></td> </tr>";
}
$db->close();
echo "</table>
</body>
</html>";

?>
