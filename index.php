<?php require('functions.php');
require('data.php');


date_default_timezone_set("Europe/Moscow");
//$now =  strtotime(date(H . i));
$end_time = strtotime(date('13.03.2020'));
$now = strtotime('now');
$hour_remaining = ($end_time - $now);
$minute_remaining =  ($now % 86400) % 3600;

$page_content = render('index.php', ['offer' => $offer, 'now' => $now, 'hour_remaining' => $hour_remaining]);


$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'GifTube - Главная', 'categories' => $categories]
);
print($layout_content);