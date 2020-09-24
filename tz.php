<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$quote_home  =   getenv('quote_home',true) ? getenv('quote_home', true) : '.';
require     $quote_home . '/vendor/autoload.php';

/*
 * Email properties
 * 
 */

if($argc < 2) {
	echo "usage: php tz.php tz.ini\n";
	exit(-1);
}

$props	 = parse_ini_file($quote_home . "/" . $argv[1] ); 

$names		= array();
$tzs		= array();
$utcs		= array();
$details	= array();

foreach ($props['name']  	as $name) 	{ array_push( $names, 	$name); }
foreach ($props['tz']  		as $tz) 	{ array_push( $tzs, 	$tz); }
foreach ($props['utc']  	as $utc) 	{ array_push( $utcs, 	$utc); }
foreach ($props['detail']  	as $detail) { array_push( $details, $detail); }

$db     =       new SQLite3($quote_home . "/Quote.db");
$db->exec("DROP  TABLE Tz"); 
$db->exec("CREATE TABLE IF NOT EXISTS Tz (
	name    text,
	tz 		text,
	utc     text,
	detail  text,
	created datetime,
	cr_date text,
	cr_time text)");

$stmt = $db->prepare("INSERT INTO Tz (name, tz, utc, detail, cr_date, cr_time, created) 
			VALUES (:name, :tz, :utc, :detail, :cr_date, :cr_time, current_timestamp)");

for($i=0;$i<count($names);$i++) {
	$stmt->bindValue(':name', 	$names[$i]);
	$stmt->bindValue(':tz',		$tzs[$i]);
	$stmt->bindValue(':utc', 	$utcs[$i]);
	$stmt->bindValue(':detail',	$details[$i]);
	$stmt->bindValue(':cr_date', date('Y-m-d'));
	$stmt->bindValue(':cr_time', date('G:i:s'));
	$stmt->execute();
}

$db->close();


?>
