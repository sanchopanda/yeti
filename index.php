<?php require('functions.php'); 
require('data.php'); 


date_default_timezone_set("Europe/Moscow");
$now =  strtotime(date(H.i));

$tomorow = strtotime(date(d));


$page_content = render('index.php', ['offer' => $offer, 'now' => $now, 'tomorow' = $tomorow]);


$layout_content = render('layout.php',
 ['content'=> $page_content, 'title' => 'GifTube - Главная', 'categories'=> $categories]);
print($layout_content);

?>