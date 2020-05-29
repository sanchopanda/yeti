<?php require('functions.php');
require('init.php');
session_start();

if (!$connection) {
    $error = mysqli_connect_error();
    $page_content = render('error.php', ['error' => $error]);
} else {

    $search = $_GET['search'] ?? '';


    if ($search) {


        mysqli_query($connection, 'CREATE FULLTEXT INDEX lots_ft_search ON lots(title, description)');

        $sql = 'SELECT  lots.id as lot_id, start_date, title, description, image, start_price, finish_date, step, count_favor, author_id, winner_id, categories.category_name as category_id FROM lots
        JOIN categories ON lots.category_id = categories.id
        WHERE MATCH(title, description) AGAINST(?);';

        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 's', $search);
        mysqli_stmt_execute($stmt);

        $answer = mysqli_stmt_get_result($stmt);

        $lots = mysqli_fetch_all($answer, MYSQLI_ASSOC);
    };

    $page_content = render('search.php', ['lots' => $lots, 'search' => $search]);
};

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Поиск', 'categories' => $categories]
);

print($layout_content);