<?php include('common.php'); ?>
<?php include('menu.php'); ?>
<?php 
$path = '../Sona'; // '.' for current
$dir = $path;
$cnt = 1;

$images = glob($dir . "/*.{jpg,gif,png}", GLOB_BRACE);
$listImages=array();
foreach($images as $image){
		$listImages=$image;
		$listImages = str_replace("..", "", $listImages);
			$url = $quote_url . $listImages;
            echo "<img src='" . ($url) . "' width=600< /img> <br><br>";
			$cnt++;
       }

echo "Total: " . $cnt;
?>

</body>
</html>
