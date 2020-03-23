<?php require('functions.php');
require('data.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    if (!empty($_FILES['lot-image']['name'])) {
        $tmp_name = $_FILES['lot-image']['tmp_name'];
        $path = $_FILES['lot-image']['name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);

        if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
            $errors['lot-image'] = 'Загрузите изображение в формате jpeg или png';
        } else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            $lot['path'] = $path;
        };
    } else {
        $errors['lot-image'] = 'Вы не загрузили файл';
    };

    $page_content = render('add.php', ['lot' => $lot, 'errors' => $errors, 'categories' => $categories]);
} else {
    $page_content = render('add.php', ['categories' => $categories]);
};



$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);