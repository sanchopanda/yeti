<?php require('functions.php');
require('init.php');

session_start();

if (!$connection) {
    $error = mysqli_connect_error();
    $page_content = render('error.php', ['error' => $error]);
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $required_fields = ['email', 'password'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Поле не заполнено';
        };
    };

    if (!count($errors)) {
        if ($user = searchUserByEmail($form['email'], $users)) {
            if (password_verify($form['password'], $user['password'])) {
                $_SESSION['user'] = $user;
            } else {
                $errors['password'] = 'Неверный пароль';
            }
        } else {
            $errors['email'] = 'Такой пользователь не найден';
        }
    }

    if (count($errors)) {
        $page_content = render('login.php', ['form' => $form, 'errors' => $errors]);
    } else {
        $page_content = render('index.php', ['lots' => $lots]);
    }
} else {
    $page_content = render('login.php', []);
};


$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);