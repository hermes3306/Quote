<?php include('common.php'); ?>
<?php include('menu.php'); ?>
<?php 
$path = '..'; // '.' for current
   foreach (new DirectoryIterator($path) as $file) {
   if ($file->isDot()) continue;

   if ($file->isDir()) {
       $dir = $path.'/'. $file->getFilename();

    $images = glob($dir . "/*.{jpg,gif,png}", GLOB_BRACE);
       $listImages=array();
       foreach($images as $image){
		$listImages=$image;
		$listImages = str_replace("..", "", $listImages);
			$url = $quote_url . $listImages;
            echo "<img src='" . ($url) . "' width=600< /img> <br><br>";
       }
   }
}
?>

</body>
</html>
