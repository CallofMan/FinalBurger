<?php
    SESSION_START();

    require_once 'connection.php';

    if (isset($_POST['goDiscount']))
    {
        $queryForSession = mysqli_query($link, "SELECT first_name, surname, buyers_code FROM `buyers`");

        $codeBuyer = $_POST['codeBuyer'];
        $dataFirstName = [];
        $dataSurname = [];
        $dataBuyersCode = [];

        while($resultForSession = mysqli_fetch_assoc($queryForSession))
        {
            array_push($dataFirstName, $result['first_name']);
            array_push($dataSurname, $result['surname']);
            array_push($dataBuyersCode, $result['buyers_code']);
        }

        $_SESSION['codeBuyer'] = $codeBuyer;
    
        header('Location: order.php');
    }

    $query = mysqli_query($link, "SELECT first_name, surname, buyers_code FROM `buyers`");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/images/house.png" type="image/x-icon">
</head>
<body>
    <div id="boxCheckCode">
        <p id="infoBuyer"></p>
        <button name='show' id='show'>Чекнуть челика</button>
        <form method="POST" class='formButton'>
            <input type="text" placeholder='Введите код' name='codeBuyer' class='intoFormButton' id='chekCode' required autofocus>
            <button name='goDiscount' class='intoFormButton'>Перейти к заказу</button>
        </form>
        <div id="links">
            <a href="deleteAddFood.php"><img src="images\food.png"></a>
            <a href="allUsers.php"><img src="images\men.png"></a>
            <a href="authCashier.php"><img src="images\man.png"></a>
        </div>    
    </div>

    <script>
        var chek = document.getElementById('show');
        var p = document.getElementById('infoBuyer');
        var dataBuyersCode = [];
        var dataSurname = [];
        var dataFirstName = [];

        <?php
            while($result = mysqli_fetch_assoc($query))
            {
            ?>  dataFirstName.push('<?php echo $result['first_name'];?>');
                dataSurname.push('<?php echo $result['surname'];?>');
                dataBuyersCode.push(<?php echo $result['buyers_code'];?>);
            <? } ?>
        
        chek.addEventListener('click', function()
        {
            var chekCode = document.getElementById('chekCode');

            for(var i = 0; i <= dataBuyersCode.length; i++)
            {
                if(chekCode.value == dataBuyersCode[i])
                {   
                    p.textContent = dataFirstName[i] + ' ' + dataSurname[i];
                    break;
                }
            }
        })
        
    </script>
</body>
</html>