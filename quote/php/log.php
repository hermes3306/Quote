<html><body>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>
<?php

$cont = file_get_contents($quote_home . "/Quote.log"); 
echo nl2br($cont);

?>
</body>
</html>
