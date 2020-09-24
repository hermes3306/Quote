<html><body>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>

<?php 
echo "

<table border='0' align='left'>
<tr>
<td>Name</td>
<td>Day</td>
<td>Subject</td>
<td>Date</td>
<td>Time</td>
<td>Status</td>
</tr> ";

$db     =       new SQLite3($dbfile);

$res = $db->query('SELECT * FROM Quote');
while ($row = $res->fetchArray()) {
                echo "<tr>	<td>{$row['name']}</td> 
			  	<td>{$row['day']}</td>
			  	<td>{$row['subject']}</td>
			  	<td>{$row['cr_date']}</td>
			  	<td>{$row['cr_time']}</td>
				<td>{$row['status']}</td> </tr>";
}
$db->close();
echo "</table>
</body>
</html>";

?>
