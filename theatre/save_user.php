<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="theatre.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Театр NO NAME</title>
</head>
<body>
<div class="header">
    <div class="title">
        <div class="container-header">
            <img class="icon logo" src="image/theatre.png" alt="theatre">
            <h1 class="logo">Театр NO NAME</h1>
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
</div>

<?php
if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }
if (isset($_POST['name'])) { $name=$_POST['name']; if ($name =='') { unset($name);} }
if (isset($_POST['pass'])) { $pass = $_POST['pass']; if ($pass == '') { unset($pass);} }
if (isset($_POST['repass'])) { $repass=$_POST['repass']; if ($repass =='') { unset($repass);} }
if (isset($_POST['date'])) { $date = $_POST['date']; if ($date == '') { unset($date);} }

$checkname = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";

if(empty($email) || empty($name) || empty($pass) || empty($repass) || empty($date)){

    echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Заполните все поля!</b>
			</div>
		";
    exit();
} else {
    if (!preg_match($checkname, $name)) {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$name не возможно!</b>
			</div>
		";
        exit();
    }
    if (!preg_match($emailValidation, $email)) {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$email Невозможен!</b>
			</div>
		";
        exit();
    }
    if (strlen($pass) < 9) {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Пароль короткий!</b>
			</div>
		";
        exit();
    }
    if (strlen($repass) < 9) {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Пароль короткий!</b>
			</div>
		";
        exit();
    }
    if ($pass != $repass) {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Проль не одинаковый!</b>
			</div>
		";
    }
}
$date = date('Y-m-d', strtotime($_POST['date']));
// подключаемся к базе
include ("connection_to_database.php");
// проверка на существование пользователя с таким же логином
$query = "SELECT id_user FROM user WHERE e_mail='$email' LIMIT 1";
$result = mysqli_query($link, $query);
$myrow = mysqli_fetch_array($result);
if (!empty($myrow['id_user'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
}
// если такого нет, то сохраняем данные
$query2 = "INSERT INTO user VALUES(NULL, '$name', '$email', '$pass', '$date')";
$result2 = mysqli_query($link, $query2);
// Проверяем, есть ли ошибки

if ($result2)
{
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a class='login' href='login_form.php'>Вход</a>";
}
else {
    echo "Ошибка! Вы не зарегистрированы. Попробуйте еще раз. <a class='login' href='registration_form.php'>Вход</a> ";
}
?>
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

