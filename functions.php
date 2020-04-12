<?php
function render($name, $data)
{
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
};

function price($num)
{
    $price = ceil($num);
    if ($price > 1000) {
        $price = number_format($price, 0, '.', ' ');
    };
    $price = $price . " Р";
    print($price);
};

function time_remaining()
{
    date_default_timezone_set("Europe/Moscow");
    $now = strtotime('now');
    $second_today = $now % 86400;
    $second_remaining = 86400 - $second_today - 10800;
    $hour_remaining = floor($second_remaining / 3600);
    $minute_remaining = floor(($second_remaining % 3600) / 60);
    $time_remaining = $hour_remaining . ':' . $minute_remaining;
    print($time_remaining);
};

function searchUserByEmail($formEmail, $userData)
{
    foreach ($userData as $key => $value) {
        if ($formEmail == $value['email']) {
            return $value;
        }
    }
    return false;
};

function get_lot_for_id($lot_id)
{
    return "
    SELECT lots.id, start_date, title, description, image, start_price, finish_date, step, author_id, winner_id, COUNT(bets.lot_id) as count_favor, IFNULL(MAX(bets.current_price), lots.start_price) as bets_price
FROM lots
JOIN bets ON lots.id = bets.lot_id
WHERE lots.id =" . $lot_id . ";  
  ";
};

function get_bets_for_id($lot_id)
{
    return "
    SELECT users.name , bets.current_price, bets.date
    FROM bets
    INNER JOIN lots ON lots.id = bets.lot_id
    LEFT JOIN users ON users.id = bets.user_id
    WHERE lots.id = " . $lot_id . "
    ORDER BY DATE DESC;
    ";
};