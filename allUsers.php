<?php
    SESSION_START();

    require_once 'connection.php';

    if (isset($_POST['addBuyer'])) 
        {
        $randCode = randCode();
        
        $buyerName = $_POST['addBuyerName'];
        $buyerSurname = $_POST['addBuyerSurname'];
    
        $queryAdd = mysqli_query($link, "INSERT INTO `buyers` (first_name, surname, buyers_code, summ_score, quantity_bonuses) VALUES ('$buyerName', '$buyerSurname', '$randCode', null, null)");

        header('Location: pageOfCode.php');
    }

    $query = mysqli_query($link, "SELECT id_buyer, first_name, surname, buyers_code FROM `buyers`");

    if(isset($_POST['mainPage'])){
        header('Location: index.php');
    }
    if(isset($_POST['addPos'])){
        header('Location: deleteAddFood.php');
    }
    if(isset($_POST['authCash'])){
        header('Location: authCashier.php');
    }
?>
<?php function randCode()
{
    global $link;
    $queryCode = mysqli_query($link, "SELECT buyers_code FROM `buyers`");
    $resultCode = mysqli_fetch_array($queryCode);

    $key = 1;
    while ($key == 1)
    {
        $randCode = rand(10000, 99999);
        

        for ($i = 0; $i <= count($resultCode); $i++)
        {
            if ($resultCode[$i] == $randCode)
            {
                $key = 1;
                break;
            }
            
            $key = 0;
        }

        if ($key == 0)
        {
            $_SESSION['code'] = $randCode;
            return($randCode);
        }
    }
}
?>
<?php
    $id = [];
    $nameU = [];
    $surnameU = [];
    $code = [];
    while ($result = mysqli_fetch_assoc($query)){
        array_push($id, $result['id_buyer']);
        array_push($nameU, $result['first_name']);
        array_push($surnameU, $result['surname']);
        array_push($code, $result['buyers_code']);
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Люди</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/images/people.jpg" type="image/x-icon">
</head>
<body>

<div id="boxAddUser">

    <div class='allInputs'>

        <form class="addUser" method="POST">
            <input type="text" placeholder='Имя' name='addBuyerName' required>
            <input type="text" placeholder='Фамилия' name='addBuyerSurname' required>
            <button name="addBuyer">Добавить пользователя</button>
        </form>
        <form class='navButtons'method='POST'>
        <button name='mainPage'> Главная </button> <br>
        <button name='addPos'> Добавление заказа </button> <br> 
        </form>

    </div>
    

    <div class='formSearch'>

        <div class='divI'>

            <input name='search 'class='search' placeholder='Enter name & surname user'>
            <input type='submit' class='searchB' value='Поиск'>

        </div>

        <script>
        window['input'] = document.querySelector('.search');

        let button = document.querySelector('.searchB');

        button.addEventListener('click', function(){
            window['input'] = document.querySelector('.search');
            
                let arrName = [];
                let arrSurname = [];
                let arrId = [];
                let arrCode = [];

                <? for ($i = 0; $i < count($nameU); $i++){ ?>
                    arrName.push("<?php echo $nameU[$i] ?>");
                    arrCode.push("<?php echo $code[$i] ?>");
                    arrId.push("<?php echo $id[$i] ?>");
                    arrSurname.push("<?php echo $surnameU[$i] ?>");
                <? } ?>

                var listU = document.querySelector('.listUsers');
                listU.innerHTML = "";
                for (var a = 0; a < arrName.length; a++){
                    
                    if (input.value == "")
                    {
                        listU.innerHTML = "";
                        for(var pdr = 0; pdr < arrName.length; pdr++)
                        {
                            listU.innerHTML += "<div class='user' id='user" + pdr + "'></div>";
                            var superUser = document.getElementById('user' + pdr);
                            superUser.innerHTML += "<p>" + arrId[pdr] + "</p> <hr>";
                            superUser.innerHTML += "<p>" + arrName[pdr] + "</p> <hr>";
                            superUser.innerHTML += "<p>" + arrSurname[pdr] + "</p> <hr>";
                            superUser.innerHTML += "<p>" + arrCode[pdr] + "</p>";
                        }
                    }
                    if (input.value == arrName[a]){
                        
                        listU.innerHTML += "<div class='user' id='user" + a + "'></div>";
                        var user = document.getElementById('user' + a);
                        user.innerHTML += "<p>" + arrId[a] + "</p> <hr>";
                        user.innerHTML += "<p>" + arrName[a] + "</p> <hr>";
                        user.innerHTML += "<p>" + arrSurname[a] + "</p> <hr>";
                        user.innerHTML += "<p>" + arrCode[a] + "</p>";
                    }           
                }
        });
        

        </script>

        <div class="listUsers">
            <?php for ($i = 0; $i < count($id); $i++) {
                echo '<div class="user">'.'<p>'. $id[$i].'</p> <hr>'.'<p>'. $nameU[$i].'</p> <hr>'.'<p>'. $surnameU[$i].'</p> <hr>'.'<p>'. $code[$i].'</p>'.'</div>';
            }
            ?>
        </div>

    </div>

</div>

</body>
</html>