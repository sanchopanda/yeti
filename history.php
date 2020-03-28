<?php require('functions.php');
require('data.php');
require('lots.php');
$cookie_id =  json_decode($_COOKIE['cookie_id']);

$page_content = render('history.php', ['lots' => $lots, 'cookie_id' => $cookie_id]);

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'GifTube - Главная', 'categories' => $categories]
);
print($layout_content);