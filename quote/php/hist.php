<html><body>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>

<?php


$name	= 		$_GET['name'];

$db     =       new SQLite3($dbfile);
echo "


<table border='0' align='left'>
<tr>
<td>Name</td>
<td>Subject</td>
<td>Day</td>
<td>Date</td>
<td>Time</td>
</tr> ";

$sql = "SELECT name, day, subject, cr_date, cr_time, url FROM quote  where url not null and  name like '" .  $name . "'";

$res = $db->query($sql);
while ($row = $res->fetchArray()) {
				$_url = str_replace("img", "img width=500", $row['url']);
                echo "<tr>  <td>{$row['name']}</td>
                <td>{$row['subject']}</td>
                <td>{$row['day']}</td>
                <td>{$row['cr_date']}</td>
                <td>{$row['cr_time']}</td> </tr>
                <tr><td colspan=5>{$_url}</td> </tr>";
}
$db->close();
echo "</table>
</body>
</html>";

?>
