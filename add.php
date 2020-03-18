<?php require('functions.php');
require('data.php');


$page_content = render('add.php', ['categories' => $categories]);


$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);