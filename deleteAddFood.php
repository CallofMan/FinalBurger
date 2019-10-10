<?php
    require_once 'connection.php';

    $name = $_POST['addName'];
    $price = $_POST['addPrice'];
    $category = $_POST['addCategory'];
    $procentDisc = $_POST['procentDiscount'];
    $dayDisc = $_POST['dayDiscount'];
    if(isset($_POST['return'])){
        header('Location: index.php');
    }
    if(isset($_POST['addFood']))
    {
        $query = mysqli_query($link, "INSERT INTO `products` (name_product, price, category, day_discount, discount_summ) VALUE ('$name', '$price', '$category', '$dayDisc', '$procentDisc')");
        header("Location: deleteaddFood.php?");
    }

    $query = mysqli_query($link, "SELECT name_product, price, category, day_discount, discount_summ FROM `products`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Еда</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/images/gvn.png" type="image/x-icon">
</head>
<body>

    <div id="boxDelete">

        <form class="navigationPanel" method='POST'>
            <input type="text" placeholder='Название' name='addName'>
            <input type="text" placeholder='Цена' name='addPrice'>
            <input type="text" placeholder='Категория' name='addCategory'>
            <input type="text" placeholder='День скидки' name='dayDiscount'>
            <input type="text" placeholder='Процент скидки' name='procentDiscount'>
            <button name="addFood" class='addFood'>Добавить позицию</button>
            <button name="return">Главная</button>
        </form>

        <div class='listFood'> 

            <div class='staticDiv'> <p> Название </p> <hr> <p> Цена </p> <hr> <p> Категория </p> <hr> <p> День скидки </p> <hr> <p> Процент </p> <hr> <p> Удалить</p></div>

            <div id="positionFood">
                
                <?php
                    while ($result = mysqli_fetch_assoc($query))
                    {
                        echo  "<div class='contentFood'> <p>" . $result['name_product'] . "</p> <hr> <p>" . $result['price'] . "<?p> <hr> <p>" . $result['category'] . "</p> <hr> <p>" . $result['day_discount'] . "</p> <hr> <p>" . $result['discount_summ'] . "</p> <hr> <p> <img src='images\delete_icon.png' class='img'></p></div>";
                    }
                ?>

            </div>

        </div>

    </div>

</body>
</html>