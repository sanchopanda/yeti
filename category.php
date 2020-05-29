<?php require('functions.php');
require('init.php');
$id = $_GET['id'];

$sql = 'SELECT lots.id as lot_id, start_date, title, description, image, start_price, finish_date, step, count_favor, author_id, winner_id, categories.category_name as category_id FROM lots
JOIN categories ON lots.category_id = categories.id
WHERE lots.category_id =' . $id . ';';
$answer = mysqli_query($connection, $sql);
$lots = mysqli_fetch_all($answer, MYSQLI_ASSOC);

$page_content = render('category.php', ['lots' => $lots]);

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => '', 'categories' => $categories]
);
print($layout_content);