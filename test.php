<?php
$path = '.'; // '.' for current
   foreach (new DirectoryIterator($path) as $file) {
   if ($file->isDot()) continue;

   if ($file->isDir()) {
       $dir = $path.'/'. $file->getFilename();

	$images = glob($dir . "/*.{jpg,gif,png}", GLOB_BRACE);
       $listImages=array();
       foreach($images as $image){
           $listImages=$image;
           echo ($listImages) ."<br>";
       }
   }
}


?>
