<?php
    $host = 'localhost';
    $database = 'discount';
    $user = 'root';
    $password = '';

    $link = mysqli_connect($host, $user, $password, $database) or die ("ошибка" . mysqli_error($link));
?>