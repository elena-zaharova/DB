<?php
session_start();
include ("connection_to_database.php");

if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }
if (isset($_POST['pass'])) { $pass = $_POST['pass']; if ($pass == '') { unset($pass);} }
if (isset($_POST['pass'])) { $pass = $_POST['pass']; if ($pass == '') { unset($pass);} }
if (isset($_POST['repass'])) { $repass=$_POST['repass']; if ($repass =='') { unset($repass);} }

$id = $_SESSION['id'];
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";

if(empty($email)&& empty($pass) && empty($oldpass) && empty(repass)){
    echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Заполните все поля!</b>
			</div>
		";
    exit();
}
elseif(empty($pass) && empty($oldpass) && empty($repass)) {
    if (!preg_match($emailValidation, $email)) {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$email Невозможен!</b>
			</div>
		";
        exit();
    }else {
        $query2 =  "UPDATE user SET e_mail = '$email'
                  WHERE id_user = $id";
        $result2 = mysqli_query($link, $query2);
        if ($result2)
        {
            header("location:profile.php");
        }
        else {
            echo "Ошибка! Данные не изменены! <a class='login' href='profile.php'>Профиль</a> ";
        }
    }
}
elseif(empty($email))
{
    if (strlen($pass) < 9) {
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
        exit();
    }
    $query = "SELECT * FROM user WHERE id_user='$id'";
    $result = mysqli_query($link, $query);
    $myrow = mysqli_fetch_array($result);
    if ($myrow['password'] != '$oldpass') {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Проль не совпадает!</b>
			</div>
		";
        exit();
    }
    $query2 =  "UPDATE user SET password = '$pass'
                  WHERE id_user = $id";
    $result2 = mysqli_query($link, $query2);
    if ($result2)
    {
        header("location:profile.php");
    }
    else {
        echo "Ошибка! Данные не изменены! <a class='login' href='profile.php'>Профиль</a> ";
    }
}elseif(!empty($email)&& !empty($pass) && !empty($oldpass) && !empty(repass))
{
    if (!preg_match($emailValidation, $email)) {
        echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$email Невозможен!</b>
			</div>
		";
        exit();
    }else
        {
            if (strlen($pass) < 9) {
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
                exit();
            }
            $query = "SELECT password FROM user WHERE id_user='$id'";
            $result = mysqli_query($link, $query);
            $myrow = mysqli_fetch_array($result);
            if ($myrow['password'] != $oldpass) {
                echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Проль не совпадает!</b>
			</div>
		";
                exit();
            }
            $query2 =  "UPDATE user SET e_mail = $email, password = '$pass'
                  WHERE id_user = $id";
            $result2 = mysqli_query($link, $query2);
            if ($result2)
            {
                header("location:profile.php");
            }
            else {
                echo "Ошибка! Данные не изменены! <a class='login' href='profile.php'>Профиль</a> ";
            }

        }

}else {
    echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Заполните все поля!</b>
			</div>
		";
    exit();
}

?>