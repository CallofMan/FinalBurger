<?php
    SESSION_START();

    if (isset($_POST['return']))
    {
        header('Location: allUsers.php');
    } 
    if (isset($_POST['goHome']))
    {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Код</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/images/lock.png" type="image/x-icon">
</head>
<body>
    <form class="boxAdd" method='POST'>
        <p id='tempCode'>
        <?php echo $_SESSION['code']; ?>
        </p>

        <button name='return'>Вернуться</button>
        <button name="goHome">Домой</button>
    </form>
    <p style="font-size: 100pt; color: white; margin: 0 auto; width: 300px; text-align: center;" id="timer">10</p>
    <script>
        var timer = 10;
        var fieldTimer = document.getElementById('timer');

        setInterval(function()
        {
            --timer;
            fieldTimer.textContent = timer;
        
            if (timer == 0)
            {
                location.href = 'index.php';
            }
        }, 1000);
    </script>
</body>
</html>