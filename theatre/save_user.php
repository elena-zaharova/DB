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
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='login_form.php'>Вход</a>";
}
else {
    echo "Ошибка! Вы не зарегистрированы.";
}
?>