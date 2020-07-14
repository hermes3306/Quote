<?php
$url = "https://www.google.com/search?source=univ&tbm=isch&q=quote+friendship&sa=X&ved=2ahUKEwjeyduE8bzqAhXB7WEKHVsJBlgQ7Al6BAgKEDY&biw=1280&bih=625";
$html = file_get_contents($url);


preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $html, $matches);
var_dump($matches);

foreach($matches[0] as $key => $val) {
 echo "$key : $val"."\n";
 $img = $key . ".jpg";
 file_put_contents($img, file_get_contents($val));
}


?>
