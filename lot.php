<?php require('functions.php');
require('init.php');
require('lots.php');
$id = $_GET['id'];

$sql = get_lot_for_id($id);
$answer = mysqli_query($connection, $sql);
$lot_array = mysqli_fetch_all($answer, MYSQLI_ASSOC);
$lot = $lot_array[0];

$sql = get_bets_for_id($id);
$answer = mysqli_query($connection, $sql);
$bets = mysqli_fetch_all($answer, MYSQLI_ASSOC);


$expire = strtotime("+30 days");
$path = "/";

if ($lot) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $aad_bet = $_POST['cost'];
        $errors = [];

        if (!is_numeric($lot[$field])) {
            $errors[$field] = 'В поле должно быть число';
        };

        if (!is_numeric($lot[$field])) {
            $errors[$field] = 'В поле должно быть число';
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

    $page_content = render('lot-item.php', ['lot' => $lot, 'bets' => $bets]);
    //запись айди посещенных лотов в куки
    if ($_COOKIE['cookie_id']) {
        $cookie_id = $_COOKIE['cookie_id'];
        $cookie_id = json_decode($cookie_id);
        if (!in_array($id, $cookie_id)) {
            array_push($cookie_id, $id);
            $cookie_id = json_encode($cookie_id);
        } else {
            $cookie_id = json_encode($cookie_id);
        }
    } else {
        $cookie_id[] = $id;
        $cookie_id = json_encode($cookie_id);
    }
    setcookie('cookie_id', $cookie_id, $expire, $path);
} else {
    $page_content = render('404.php', []);
}

$layout_content = render(
    'layout.php',
    ['content' => $page_content, 'title' => $lot['title'], 'categories' => $categories]
);
print($layout_content);