<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="theatre.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Театр NO NAME</title>
</head>
<body>
<div class="header">
    <div class="title">
        <div class="container-header">
            <img class="icon logo" src="image/theatre.png" alt="theatre">
            <h1 class="logo">Театр NO NAME</h1>
            <?php
            if(isset($_SESSION["id"])) {
                echo" <a class='logo login' href='profile.php'>ПРОФИЛЬ</a>";
            }
            else
            {
                echo"<a class='logo login' href='login_form.php'>ВХОД</a>";
            }
            ?>

        </div>
    </div>
    <div class="navigation-bar">
        <div class="container-header">
            <ul class="nav-bar">
                <li class="nav"><a class="menu" href="index.php">Главная</a></li>
                <li class="nav"><a class="menu" href="afisha.php">Афиша</a></li>
                <li class="nav"><a class="menu" href="spectacle.php">Спектакли</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="content">
    <div class="cont">
        <div class="forma">
            <div style="border: 0px solid blue; position:relative; top:100px; left:400px; height:200px; width:300px;"></div>
            <form class="ui-form" action="update_acc.php" method="post">
                <h3>Данные</h3>
                <div class="form-row">
                    <label>Email<br></label>
                    <input name="email" type="text" size="30" maxlength="30">
                </div>
                <div class="form-row">
                <label>Старый пароль:<br></label>
                <input name="oldpass" type="password" size="15" maxlength="30">
                 </div>
                <div class="form-row">
                    <label>Новый пароль:<br></label>
                    <input name="pass" type="password" size="15" maxlength="30">
                </div>
                <div class="form-row">
                    <label>Повторите пароль:<br></label>
                    <input name="repass" type="password" size="15" maxlength="30">
                </div>
                <p>
                <input type="submit" name="submit" value="Сохранить"></p>
            </form>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container-header">
        <h3>O Сайте</h3>
        <ul class="footer-bar">Контакты
            <li class="footer-nav">Телефон : 12-34-56 8(556)677-86-80</li>
        </ul>
        <ul class="footer-bar">Навигация
            <li class="footer-nav"><a class="foomenu" href="index.php">Главная</a></li>
            <li class="footer-nav"><a class="foomenu" href="afisha.php">Афиша</a></li>
            <li class="footer-nav"><a class="foomenu" href="spectacle.php">Спектакли</a></li>
        </ul>
    </div>
</div>
</body>
</html>
