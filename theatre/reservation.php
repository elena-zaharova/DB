<?php
session_start();
if(!isset($_SESSION["id"])) {
    header("location:login_form.php");
}
?>


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
            <a class='logo login' href='profile.php'>ПРОФИЛЬ</a>
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

    <h2>БРОНИРОВАНИЕ</h2>
        <?php
        require_once 'connection_to_database.php';

        $user_id = $_SESSION["id"];
        $query ="SELECT * FROM user WHERE id_user = $user_id";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));



        if($result) {
            $rows = mysqli_num_rows($result);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $name = $row["name"];
                    echo "<h3>Ф.И.О. : $name</h3>";
                }
            }
        }

        mysqli_free_result($result);
        $id=0;
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $query ="SELECT * FROM spectacle
                 LEFT JOIN schedule
                 ON schedule.id_spectacle = spectacle.id_spectacle
                 LEFT JOIN hall
                 ON schedule.id_hall = hall.id_hall
                 WHERE schedule.id_schedule  = $id";

        echo"<form action='process_reservation.php?id_schedule=$id&user_id=$user_id' method='post'>";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        if($result) {
            $rows = mysqli_num_rows($result);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $namespectacle = $row["name_of_spectacle"];
                    $hall = $row["number_of_hall"];
                    $date = $row["date_spectacle"];
                    echo "<h3>Название спектакля : $namespectacle</h3>";
                    echo "<h3>Дата прохождения: : $date</h3>";
                    echo "<h3>Номер Зала : $hall</h3>";
                }
            }
        }

        echo"<p>
            <label>Количество:<br></label>
            <input type='number' name='count'>
        </p>
        <p>
            <input type='submit' name='submit' value='Забронировать'>
        </p>

    </form>"

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