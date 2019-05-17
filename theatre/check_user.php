<?php
require_once 'connection_to_database.php';

header('Content-Type: text/html; charset=utf-8');
session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }
if (isset($_POST['pass'])) { $pass = $_POST['pass']; if ($pass == '') { unset($pass);} }

$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";

if(empty($email) || empty($pass)){

    echo "
			<div class='warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
    exit();
} else {
    if (!preg_match($emailValidation, $email)) {
        echo "
			<div class='warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
        exit();
    }
    if (strlen($pass) < 9) {
        echo "
			<div class='warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
        exit();
    }
}

//извлекаем из базы все данные о пользователе с введенным логином
$query = "SELECT * FROM user WHERE e_mail= '$email'";
$result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
$myrow = mysqli_fetch_array($result);
if (empty($myrow["password"]))
{
    //если пользователя с введенным логином не существует
    exit ("<body><div align='center'><br/><br/><br/>
	<h3>Извините, введённый вами login или пароль неверный." . "<a href='login_form.php'> <b>Назад</b> </a></h3></div></body>");
}
else {
    //если существует, то сверяем пароли
    if ($myrow["password"]==$pass) {
        //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
        $_SESSION['email']=$myrow["e_mail"];
        $_SESSION['id']=$myrow["id_user"];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
        header("location:profile.php");
    }
    else {
        //если пароли не сошлись

        exit ("<body><div align='center'><br/><br/><br/>
	<h3>Извините, введённый вами login или пароль неверный." . "<a href='login_form.php'> <b>Назад</b> </a></h3></div></body>");
    }
}
?>