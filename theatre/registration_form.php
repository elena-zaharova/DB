<?php
session_start();
require_once "connection_to_database.php";
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
            <a class="logo login" href="login_form.php">ВХОД</a>
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

<h2>Регистрация</h2>
<form action="save_user.php" method="post">
    <p>
        <label>ФИО:<br></label>
        <input name="name" type="text" size="30" maxlength="30">
    </p>
    <p>
        <label>Email<br></label>
        <input name="email" type="text" size="30" maxlength="30">
    </p>
    <p>
        <label>Пароль:<br></label>
        <input name="pass" type="password" size="30" maxlength="30">
    </p>
    <p>
        <label>Повторите пароль:<br></label>
        <input name="repass" type="password" size="30" maxlength="30">
    </p>
    <p>
        <label>Дата Рождения:<br></label>
        <input type="date" name="date"   value="<?php date('Y-m-d'); ?>"
    </p>
    <p>
        <input type="submit" name="submit" value="Зарегистрироваться">
    </p></form>


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

