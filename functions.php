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