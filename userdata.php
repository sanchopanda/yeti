<?php

// пользователи для аутентификации

$sql = 'SELECT * FROM users';
$answer = mysqli_query($connection, $sql);
$users = mysqli_fetch_all($answer, MYSQLI_ASSOC);