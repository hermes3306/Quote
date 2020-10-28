<html><body>
<div>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>
</div>

<div class="cleanslate w24tz-current-time w24tz-large" style="display: inline-block !important; visibility: hidden !important; min-width:300px !important; min-height:145px !important;"><p><a href="//24timezones.com/Seoul/time" style="text-decoration: none" class="clock24" id="tz24-1600995926-c1235-eyJob3VydHlwZSI6MTIsInNob3dkYXRlIjoiMSIsInNob3dzZWNvbmRzIjoiMSIsImNvbnRhaW5lcl9pZCI6ImNsb2NrX2Jsb2NrX2NiNWY2ZDQyNTYwZmY0MyIsInR5cGUiOiJkYiIsImxhbmciOiJlbiJ9" title="Seoul timezone" target="_blank" rel="nofollow">Seoul</a></p><div id="clock_block_cb5f6d42560ff43"></div></div>
<script type="text/javascript" src="//w.24timezones.com/l.js" async></script>

<?php
echo "<br> ";
echo "<br> ";
echo "<br> ";
?>


<div>
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

$res = $db->query('SELECT * FROM Tz order by utc desc');
while ($row = $res->fetchArray()) {
				$timezone   = $row['utc'];
				$cr_date	= gmdate("m-j", time() + 3600*($timezone+date("I"))); 
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

</div>
</body>
</html>";

?>

