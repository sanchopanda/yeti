<?php require('functions.php');
require('init.php');
session_start();

if (!$connection) {
    $error = mysqli_connect_error();
    $page_content = render('error.php', ['error' => $error]);
} else if (!$_SESSION['user']) {
    header("Location: add-error.php");
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

        $add_lot_id = mysqli_insert_id($connection);
        header("Location: lot.php?id=" . $add_lot_id);
    };
};

$page_content = render('add.php', ['lot' => $lot, 'errors' => $errors, 'categories' => $categories]);

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);