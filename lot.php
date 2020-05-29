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

session_start();

if ($lot) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $add_bet = $_POST['cost'];

        if (empty($add_bet)) {
            $errors = 'Поле не заполнено';
        } else if (!is_numeric($add_bet)) {
            $errors = 'В поле должно быть число';
        } else if ($add_bet < ($lot['bets_price'] + $lot['step'])) {
            $errors = 'Минимальный шаг ставки ' . $lot['step'] . ' р.';
        };

        if (!$errors) {
            $sql = 'INSERT INTO bets (date, current_price, user_id, lot_id) VALUES (?, ?, ?, ?)';
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ssss', date("y-m-d H:m:s"), $add_bet, $_SESSION['user']['id'], $lot['id']);
            mysqli_stmt_execute($stmt);
            header("Location: lot.php?id=" . $lot['id']);
        };
    };

    $page_content = render('lot-item.php', ['lot' => $lot, 'bets' => $bets, 'errors' => $errors]);
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