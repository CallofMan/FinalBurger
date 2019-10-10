<?php
    SESSION_START();
    
    require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заказ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/images/gvn.png" type="image/x-icon">
</head>
<body>
    <div id="allElementsOrderPage">
        <div id="basketAndlinks">
            <div id="basket">
                <div id="positionBasket">

                </div>
                <div id="results">

                </div>
            </div>

            <div id="links">
                <a href="deleteAddFood.php"><img src="images\food.png"></a>
                <a href="allUsers.php"><img src="images\men.png"></a>
                <a href="authCashier.php"><img src="images\man.png"></a>
                <a href="index.php"><img src="images\home.png"></a>
            </div>
        </div>

        <div id="menu">
            <select>
                <!-- запрос на динамическое заполнение селекта категориями из базы без повторений -->

                <?php
                    $resultSelect = [];
                    $resultSelectSort = ['Все категории'];

                    $queryForSelect = mysqli_query($link, "SELECT category FROM `products`");

                    while ($resultSelect = mysqli_fetch_assoc($queryForSelect))
                    {
                        for ($i = 0; $i <= count($resultSelectSort); $i++)
                        {
                            if ($resultSelect['category'] == $resultSelectSort[$i])
                            {
                                $key = 0;
                                break;
                            }
                            else
                            {
                                $key = 1;
                            }
                            
                        }

                        if ($key == 1)
                        {
                            array_push($resultSelectSort, $resultSelect['category']);
                        }
                    }

                    $counterOption = 0;
                    for ($j = 0; $j < count($resultSelectSort); $j++)
                    {
                        $counterOption++;
                        echo "<option id='option" . $counterOption . "'>" . $resultSelectSort[$j] . "</option>";
                    }
                ?>
                <!-- -->
            </select>

            <div id="foodPositionIndex">
                    <div id="priceAndName">
                        <p id='infoMenuName'>Название</p>
                        <hr>
                        <p id='infoMenuPrice'>Цена</p>
                        <hr>
                        <p id='infoMenuDiscount'>Скидка</p>
                    </div>

                    <div id="stringsMenu">
            
                    </div>
            </div>
        </div>
    </div>

<script>
    var resultAllCategories = [];
    var id = [];
    var nameFood = [];
    var price = [];
    var categorys = [];
    var dayDiscount = [];
    var discountProcent = [];
    var countCategory = [];
    // заношу категории в массив js из массива php чтобы в дальнейшем работать с ним в js
    <?php for ($t = 0; $t < count($resultSelectSort); $t++)
    {
        ?> countCategory.push("<?php echo $resultSelectSort[$t]; ?>")
    <?php } ?>

    var stringsMenu = document.getElementById('stringsMenu');
    //

    <?php
    // вывожу все данные из продуктов в разные массивы в js
        $queryAllCategories = mysqli_query($link, "SELECT * FROM `products`");

        while ($resultAllCategories = mysqli_fetch_assoc($queryAllCategories))
        {
    ?>
        id.push("<?php echo $resultAllCategories['id_product'] ?>");
        price.push("<?php echo $resultAllCategories['price'] ?>");
        nameFood.push("<?php echo $resultAllCategories['name_product'] ?>");
        categorys.push("<?php echo $resultAllCategories['category'] ?>");
        dayDiscount.push("<?php echo $resultAllCategories['day_discount'] ?>");
        discountProcent.push("<?php echo $resultAllCategories['discount_summ'] ?>");
    <?php } ?>
    //

    // функция добавления в зависимости от выбранной категории
    function category(category)
    {
        stringsMenu.innerHTML = '';
        for (var j = 0; j < id.length; j++)
        {
            if (category == "Все категории")
            {
                stringsMenu.innerHTML += "<div class='fieldInfoOrder' id='stringMenu" + id[j] + "'></div>";
                var stringMenu = document.getElementById('stringMenu' + id[j]);
                stringMenu.innerHTML += "<p class='infoMenuName'>" + nameFood[j] + " </p> <hr>";
                stringMenu.innerHTML += "<p class='infoMenuPrice'>" + price[j] + " ₽ </p> <hr>";
                stringMenu.innerHTML += "<p class='infoMenuDiscount'>" + discountProcent[j] + " % </p>";
            }

            if (categorys[j] == category)
            {
                stringsMenu.innerHTML += "<div class='fieldInfoOrder' id='stringMenu" + id[j] + "'</div>";
                var stringMenu = document.getElementById('stringMenu' + id[j]);
                stringMenu.innerHTML += "<p class='infoMenuName'>" + nameFood[j] + " </p>";
                stringMenu.innerHTML += "<p class='infoMenuPrice'>" + price[j] + " ₽ </p>";
                stringMenu.innerHTML += "<p class='infoMenuDiscount'>" + discountProcent[j] + " % </p>";
            }
        }

        var orders = document.querySelectorAll('.fieldInfoOrder');
        var positionBasket = document.getElementById('positionBasket');
        var counterBasket = 0;
        var allSumm = 0;
        var allDiscount = 0;
        var allProcent = 0;
        var resultsSumm = 0;
        var summ = 0;
        var discount = 0;
        var allSuperSumm = 0;

        orders.forEach(function(dick) 
        {
            dick.addEventListener('click', () => {
                counterBasket++;
                var id = dick.getAttribute('id');
                positionBasket.innerHTML += "<div class='divBasket' id='divBasket" + counterBasket + "'> </div>";
    
                var divBasket = document.getElementById('divBasket' + counterBasket); 
                var idTrue = document.querySelector('#' + id);
                var name = idTrue.querySelector('.infoMenuName');
                var price = idTrue.querySelector('.infoMenuPrice');
                var discountProcent = idTrue.querySelector('.infoMenuDiscount');
                discount = parseInt(price.textContent) / 100 * parseInt(discountProcent.textContent);
                summ = parseInt(price.textContent) - discount;

                divBasket.innerHTML += "<p class='basketName'> Название: " + name.textContent + " </p> <hr>";
                divBasket.innerHTML += "<p class='basketPrice'> Цена: " + price.textContent + " </p> <hr>";
                divBasket.innerHTML += "<p class='basketDiscountProcent'> Процент: " + discountProcent.textContent + " </p> <hr>";
                divBasket.innerHTML += "<p class='basketDiscountSumm'> Сумма %: " + discount + " ₽ </p> <hr>";
                divBasket.innerHTML += "<p class='basketSumm'> Сумма: " + summ + " ₽ </p> ";

                var results = document.getElementById('results');

                allSuperSumm += parseInt(price.textContent);
                allSumm += parseInt(summ);
                allDiscount += parseInt(discount);
                allProcent = allDiscount * 100 / allSuperSumm;
                resultsSumm += allDiscount;
                
                results.innerHTML = "";

                results.innerHTML += "<p id='allSumm'> Сумма: " + allSuperSumm + " ₽ </p> <hr>";
                results.innerHTML += "<p id='allProcent'> Процент: " + allProcent.toFixed(2) + " </p> <hr>";
                results.innerHTML += "<p id='allDiscount'> Сумма %: " + allDiscount + " ₽ </p> <hr>";
                results.innerHTML += "<p id='resultsSumm'> Итоговая сумма: " + allSumm + " ₽ </p>";
            })

            
        })
    }
    //
    
    document.querySelector('select').addEventListener('change', function(event)
    {
        var content = (event.target.options[event.target.options.selectedIndex].text);
        category(content);
    })

    category('Все категории');
</script>

</body>
</html>