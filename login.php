<?php require('functions.php');
require('data.php');
require('lots.php');
require('userdata.php');

session_start();

//Валидация форм
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $required_fields = ['email', 'password'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Поле не заполнено';
        };
    };

    if (!count($errors) and $user = searchUserByEmail($form['email'], $users)) {
        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        } else {
            $errors['password'] = 'Неверный пароль';
        };
    } else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
        $page_content = render('login.php', ['form' => $form, 'errors' => $$errors]);
    }
} else {
    $page_content = render('login.php', ['categories' => $categories]);
};


$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);