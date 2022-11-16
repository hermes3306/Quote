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
	echo "usage: php Quote.php sample.ini\n";
	exit(-1);
}

$props	 = parse_ini_file($quote_home . "/" . $argv[1] ); 

$mail 	= new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPDebug 	= 	0;
$mail->ContentType	= 	"text/html";  
$mail->CharSet		=	"UTF-8"; 
$mail->Encoding 	=	"base64";

$mail->Host 		=  	$props['Host'];
$mail->Port 		= 	$props['Port'];
$mail->SMTPSecure 	=  	$props['SMTPSecure'];
$mail->SMTPAuth 	=  	$props['SMTPAuth'];
$mail->Username 	=  	$props['Username'];
$mail->Password 	=  	$props['Password'];

$mail->setFrom        	($props['setFrom']);
$mail->isHTML          	($props['isHtml']);

foreach ($props['To']  as $addr) { $mail->addAddress($addr); }
foreach ($props['Cc']  as $addr) { $mail->addCC($addr); }
foreach ($props['Bcc'] as $addr) { $mail->addBCC($addr); }

$Day0		= $props['Day0'];
$Day0 		= strtotime($Day0);
$DayN		= strtotime(date("Y-m-d"));

$N		= ($DayN - $Day0)/60/60/24;
$Name	= $props['Name'];

$DaySubject	= "<h2><string>Quote " . $N . " - " . date("l, j F Y") . "</strong></h2>";

/*
 * Quote
 * 
 *
 */
$subj = array();
foreach ($props['subj']  as $sub) {
    array_push($subj, $sub);
}

$todaysub = rand(0, count($subj) -1 );
$quotesubj = $subj[$todaysub];


$dir = $quote_home . "/quote/" . $subj[$todaysub] ;

$files = scandir($dir);
$files = array_diff($files, array('..','.'));

$cnt = count($files);
$today = rand(2, $cnt+1); /* array key begin with 2 */ 

/*
echo "\nCnt:" . $cnt;
echo "\nInx:" . $today;
echo "\n";
print_r($files);
*/



$url		= $props['url'] . "/" . $subj[$todaysub] . "/" . $files[$today];

echo $url;

/*
 * Email Subject and Body
 * 
 *
 */

$url 	= "<img src='" .$url . "'/>" ;

$daycont        = file_get_contents($props['temp']);

$daycont		= str_replace("{{Today}}", date("l, j F Y"), $daycont);
$daycont		= str_replace("{{Day}}", $N, $daycont);


$Subject                = "Quote of  day" . $N . " for " . $props['Name'];
$Body                   = $daycont . "<br><br>" . $url; 

$mail->Subject =  	$Subject;
$mail->Body =        	$Body;
$mail->send();

echo "" . date("m-d-Y G:i:s") . " - Quote of Day " . $N . " for " . $props['Name'] . " sent!\n" ;

$db     =       new SQLite3($quote_home . "/Quote.db");
$db->exec("CREATE TABLE IF NOT EXISTS Quote (
	name    text,
	subject text,
	day     integer,
	status  text,
	created datetime,
	cr_date text,
	url		text,	
	cr_time text)");

$stmt = $db->prepare("INSERT INTO Quote (name, subject, day, status, cr_date, cr_time, created, url) 
			VALUES (:name, :subject, :day, :status, :cr_date, :cr_time, current_timestamp, :url)");
$stmt->bindValue(':name', $props['Name']);
$stmt->bindValue(':subject', $quotesubj );
$stmt->bindValue(':day', $N );
$stmt->bindValue(':status', 'OK');
$stmt->bindValue(':cr_date', date('Y-m-d'));
$stmt->bindValue(':cr_time', date('G:i:s'));
$stmt->bindValue(':url', $url);
$stmt->execute();
$db->close();



?>
