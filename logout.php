<?php require('functions.php');
require('init.php');
require('data.php');
require('lots.php');
require('userdata.php');

session_start();

$_SESSION['user'] = false;

$page_content = render('index.php', ['lots' => $lots]);

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);