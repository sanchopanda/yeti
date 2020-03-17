<?php require('functions.php');
require('lots.php');
require('data.php');
$id = $_GET['id'];
$lot = $lots[$id];

if ($lot) {
    $page_content = render('lot-item.php', ['lot' => $lot]);
} else {
    $page_content = render('404.php', []);
}

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => $lot['name'], 'categories' => $categories]
);
print($layout_content);