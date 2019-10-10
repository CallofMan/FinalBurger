<?php
    SESSION_START();

    require_once 'connection.php';

    if (isset($_POST['enter'])){

    $login = $_POST['authLogin'];
    $password = $_POST['authPass'];

    $auth = mysqli_query($link, "SELECT login, password FROM `cashiers` WHERE `login` = '$login' AND `password` = '$password'");

    $result = mysqli_fetch_assoc($auth);
        if ($result['login'] == $login && $result['password'] == $password){
            //header('Location: allUsers.php');
        }

    $getId = mysqli_query($link, "SELECT id_cashier FROM `cashiers` WHERE `login` = '$login' AND `password` = '$password'");
    $res = mysqli_fetch_assoc($getId);

    $_SESSION['id'] = $res['id_cashier'];

    }

    if (isset($_POST['returnB'])){
        header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/images/into.png" type="image/x-icon">
</head>
<body>

    <form class='boxAdd' method='POST'> 
        <h1 style="color: white; font-size: 30pt;">Авторизация</h1>
        <input type="text" placeholder='Введите логин' name='authLogin'>
        <input type="password" placeholder='Введите пароль' name='authPass'>
        <button name='enter'>Войти</button>
    </form>

    <form class='return' method='POST'>
        <button name='returnB' class='returnB'>Вернуться на главную страницу</button>
    </form>

</body>
</html>