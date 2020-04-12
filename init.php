<?php
$connection = mysqli_connect('localhost', 'root', '', 'yeticave');
mysqli_set_charset($connection, "utf8");


$sql = 'SELECT * FROM categories';
$answer = mysqli_query($connection, $sql);
$categories = mysqli_fetch_all($answer, MYSQLI_ASSOC);