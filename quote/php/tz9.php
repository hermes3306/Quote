<html><body>
<div>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>
</div>


<div style="text-align:center;padding:1em 0;"> <h3><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/en/city/4887398"><span style="color:gray;">Sona</span><br />Chicago, United States</a></h3> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=America%2FChicago" width="100%" height="115" frameborder="0" seamless></iframe> </div>

<div style="text-align:center;padding:1em 0;"> <h3><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/en/country/tt"><span style="color:gray;">Britni</span><br />Trinidad and Tobago</a></h3> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=America%2FPort_of_Spain" width="100%" height="115" frameborder="0" seamless></iframe> </div>


<div style="text-align:center;padding:1em 0;"> <h3><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/en/city/3469058"><span style="color:gray;">Meyse</span><br />Brasília, Brazil</a></h3> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=America%2FSao_Paulo" width="100%" height="115" frameborder="0" seamless></iframe> </div>

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

