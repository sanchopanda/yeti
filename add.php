<?php require('functions.php');
require('init.php');
session_start();

if (!$connection) {
    $error = mysqli_connect_error();
    $page_content = render('error.php', ['error' => $error]);
} else if (!$_SESSION['user']) {
    $page_content = render('404.php', []);
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;
    $required_fields = ['lot-name', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $numeric_fields = ['lot-rate', 'lot-step'];
    $errors = [];

    foreach ($numeric_fields as $field) {
        if (!is_numeric($lot[$field])) {
            $errors[$field] = 'В поле должно быть число';
        };
    };

    foreach ($required_fields as $field) {
        if (empty($lot[$field])) {
            $errors[$field] = 'Поле не заполнено';
        };
    };

    foreach ($categories as $key => $value) {
        if ($value['category_name'] == $lot['category']) {
            $lot['category_id'] = $value['id'];
        }
    }

    if (!$lot['path']) {
        if (!empty($_FILES['lot-image']['name'])) {
            $tmp_name = $_FILES['lot-image']['tmp_name'];
            $path = $_FILES['lot-image']['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);

            if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
                $errors['lot-image'] = 'Загрузите изображение в формате jpeg или png';
            } else {
                move_uploaded_file($tmp_name, 'img/' . $path);
                $lot['path'] = 'img/' . $path;
            };
        } else {
            $errors['lot-image'] = 'Вы не загрузили файл';
        };
    }

    if (empty($errors)) {
        $sql = 'INSERT INTO lots (start_date, title, description, image, start_price, finish_date, step, author_id, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssss', date("y-m-d H:m:s"), $lot['lot-name'], $lot['message'], $lot['path'], $lot['lot-rate'], $lot['lot-date'], $lot['lot-step'], $_SESSION['user']['id'], $lot['category_id']);
        mysqli_stmt_execute($stmt);




        /* $sql = 'SELECT start_date, title, description, image, start_price, finish_date, step, count_favor, author_id, winner_id, categories.category_name as category_id FROM lots
JOIN categories ON lots.category_id = categories.id';
        $answer = mysqli_query($connection, $sql);
        $lots = mysqli_fetch_all($answer, MYSQLI_ASSOC);*/
        $add_lot_id = mysqli_insert_id($connection);
        header("Location: lot.php?id=" . $add_lot_id);

        /*
        $add_lot['start_date'] = date("y-m-d H:m:s");
        $add_lot['title'] = $lot['lot-name'];
        $add_lot['description'] = $lot['message'];
        $add_lot['image'] = $lot['path'];
        $add_lot['start_price'] = $lot['lot-rate'];
        $add_lot['finish_date'] = $lot['lot-date'];
        $add_lot['step'] = $lot['lot-step'];
        $add_lot['count_favor'] = $_SESSION['user']['id'];
        $add_lot['category_id'] = $lot['category_id'];


        $page_content = render('lot-item.php', ['lot' => $add_lot]);*/
    };
};

$page_content = render('add.php', ['lot' => $lot, 'errors' => $errors, 'categories' => $categories]);

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);