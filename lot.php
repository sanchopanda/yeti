<?php require('functions.php');
require('lots.php');
require('data.php');
$id = $_GET['id'];
$lot = $lots[$id];
$expire = strtotime("+30 days");
$path = "/";

if ($lot) {
    $page_content = render('lot-item.php', ['lot' => $lot]);
    //запись айди посещенных лотов в куки
    if ($_COOKIE['cookie_id']) {
        $cookie_id = $_COOKIE['cookie_id'];
        $cookie_id = json_decode($cookie_id);
        if (!in_array($id, $cookie_id)) {
            array_push($cookie_id, $id);
            $cookie_id = json_encode($cookie_id);
        };
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
    ['content' => $page_content, 'title' => $lot['name'], 'categories' => $categories]
);
print($layout_content);