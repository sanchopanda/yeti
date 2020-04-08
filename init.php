<?php
$connection = mysqli_connect('localhost', 'root', '', 'yeticave');
mysqli_set_charset($connection, "utf8");

$sql = 'SELECT start_date, title, description, image, start_price, finish_date, step, count_favor, author_id, winner_id, categories.category_name as category_id FROM lots
JOIN categories ON lots.category_id = categories.id';
$answer = mysqli_query($connection, $sql);
$lots = mysqli_fetch_all($answer, MYSQLI_ASSOC);

$sql = 'SELECT * FROM users';
$answer = mysqli_query($connection, $sql);
$users = mysqli_fetch_all($answer, MYSQLI_ASSOC);

$sql = 'SELECT * FROM categories';
$answer = mysqli_query($connection, $sql);
$categories = mysqli_fetch_all($answer, MYSQLI_ASSOC);