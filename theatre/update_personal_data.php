<?php
session_start();
include ("connection_to_database.php");

if (isset($_POST['name'])) { $name=$_POST['name']; if ($name =='') { unset($name);} }
if (isset($_POST['date'])) { $date = $_POST['date']; if ($date == '') { unset($date);} }
$id = $_SESSION['id'];
$checkname = "/^[a-zA-Z ]+$/";

if(empty($name)&& empty($date)){

    echo "
			<div class='warning'>
				<a href='profile.php.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Заполните поля!</b>
			</div>";
    exit();
} else {
    if(empty($date)){
        if (!preg_match($checkname, $name)) {
            echo "
			<div class='warning'>
				<a href='registration_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$name не возможно!</b>
			</div>";
            exit();
        }else{
            $query = "UPDATE user SET name = '$name'
                  WHERE id_user = $id";
            $result = mysqli_query($link, $query);
            if ($result)
            {
                header("location:profile.php");
            }
            else {
                echo "Ошибка! Данные не изменены! <a class='login' href='profile.php'>Профиль</a> ";
            }
        }

    }elseif (empty($name)){
        $date = date('Y-m-d', strtotime($_POST['date']));
        $query = "UPDATE user SET date_of_birth = '$date'
                  WHERE id_user = $id";
        $result = mysqli_query($link, $query);
        if ($result)
        {
            header("location:profile.php");
        }
        else {
            echo "Ошибка! Данные не изменены! <a class='login' href='profile.php'>Профиль</a> ";
        }

    }elseif (!empty($name)&& !empty($date)){
        $date = date('Y-m-d', strtotime($_POST['date']));
        $query = "UPDATE user SET name = $name, date_of_birth = '$date'
                  WHERE id_user = $id";
        $result = mysqli_query($link, $query);
        if ($result)
        {
            header("location:profile.php");
        }
        else {
            echo "Ошибка! Данные не изменены! <a class='login' href='profile.php'>Профиль</a> ";
        }

    }
}
?>