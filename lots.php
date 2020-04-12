<?php
$sql = 'SELECT lots.id as lot_id, start_date, title, description, image, start_price, finish_date, step, count_favor, author_id, winner_id, categories.category_name as category_id FROM lots
JOIN categories ON lots.category_id = categories.id';
$answer = mysqli_query($connection, $sql);
$lots = mysqli_fetch_all($answer, MYSQLI_ASSOC);