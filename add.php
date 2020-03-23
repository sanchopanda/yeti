<?php require('functions.php');
require('data.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $required_fields = ['lot-name', 'message'];
    $errors = [];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        };
    };

    if ( ! sizeof( $_FILES ) ) {
        $tmp_name = $_FILES['lot-image']['tmp_name'];
        $path = $_FILES['lot-image']['name'];

        /*$finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);        */
        //$errors['lot-image'] = 'Вы не загрузили файл';
        move_uploaded_file($tmp_name, 'img/' . $path);
    } else {
        $errors['lot-image'] = 'Вы не загрузили файл';
    };

    $page_content = render('add.php', ['path' => $path, 'errors' => $errors]);
} else {
    $page_content = render('add.php', []);
};



$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => 'Добавить лот', 'categories' => $categories]
);
print($layout_content);