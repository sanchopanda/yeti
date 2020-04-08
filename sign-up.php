<?php require('functions.php');
require('init.php');
require('data.php');
require('lots.php');
session_start();

if (!$connection) {
    $error = mysqli_connect_error();
    $page_content = render('error.php', ['error' => $error]);
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUser = $_POST;
    $required_fields = ['email', 'password', 'name',  'contact'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($newUser[$field])) {
            $errors[$field] = 'Поле не заполнено';
        };
    };

    $sql = 'SELECT "id", `email` FROM users';
    $answer = mysqli_query($connection, $sql);
    $result = mysqli_fetch_all($answer, MYSQLI_ASSOC);

    if ($user = searchUserByEmail($newUser['email'], $result)) {
        $errors['email'] = 'Пользователь с таким email уже есть';
    }
    if (!$newUser['path']) {
        if (!empty($_FILES['image']['name'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $path = $_FILES['image']['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);

            if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
                $errors['image'] = 'Загрузите изображение в формате jpeg или png';
            } else {
                move_uploaded_file($tmp_name, 'img/' . $path);
                $newUser['path'] = 'img/' . $path;
            };
        } else {
            $errors['image'] = 'Вы не загрузили файл';
        };
    }

    if (count($errors)) {
        $page_content = render('sign-up.php', ['newUser' => $newUser, 'errors' => $errors]);
    } else {
        $sql = 'INSERT INTO users (reg_date, email, name, password, avatar, contact) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssss', date("y-m-d H:m:s"), $newUser['email'], $newUser['name'], password_hash($newUser['password'], PASSWORD_DEFAULT), $newUser['path'], $newUser['contact']);
        mysqli_stmt_execute($stmt);
        $page_content = render('index.php', ['lots' => $lots]);
    }
} else {
    $page_content = render('sign-up.php', []);
};




$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);