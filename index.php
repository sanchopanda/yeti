<?php require('functions.php');
require('init.php');
require('lots.php');

$page_content = render('index.php', ['lots' => $lots]);

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'GifTube - Главная', 'categories' => $categories]
);
print($layout_content);