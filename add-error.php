<?php require('functions.php');
require('init.php');


$page_content = render('add-error.php', []);

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'GifTube - Главная', 'categories' => $categories]
);
print($layout_content);