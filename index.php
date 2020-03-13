<?php require('functions.php');
require('data.php');


$page_content = render('index.php', ['offer' => $offer]);


$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'GifTube - Главная', 'categories' => $categories]
);
print($layout_content);