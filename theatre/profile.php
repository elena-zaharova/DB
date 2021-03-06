<?php
session_start();
if(!isset($_SESSION["id"])) {
    header("location:index.php");
}
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
            <a class="logo login" href="logout.php">ВЫХОД</a>
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
        <div class="profile">

<?php
require_once 'connection_to_database.php';

$user_id = $_SESSION["id"];

$query ="SELECT * FROM user WHERE id_user = $user_id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));



if($result)
{
$rows = mysqli_num_rows($result); // количество полученных строк
        echo "<h1 class='afisha'>ПРОФИЛЬ</h1>";
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $name = $row["name"];
            $date =$row["date_of_birth"];
            echo"<h2>ФИО: $name</h2></a>";
            echo"<p>Дата Рождения: $date</p>";
            $id = $_SESSION["id"];
            echo"<a class='login' href='delete_acc.php?id=$id'>Удалить аккаунт</a>";
            echo"<a class='login' href='update_acc_form.php'>Изменить Email и пароль</a>";
            echo"<a class='login' href='update_personal_data_form.php'>Изменить дату рождения и имя</a>";
            echo"</div>";
        }
        }
// очищаем результат
mysqli_free_result($result);
}

$query ="
     SELECT *
     FROM reservation
     LEFT JOIN ticket
     ON reservation.id_reservation = ticket.id_reservation
     LEFT JOIN schedule
     ON reservation.id_schedule = schedule.id_schedule
     LEFT JOIN spectacle
     ON schedule.id_spectacle = spectacle.id_spectacle
     LEFT JOIN hall
     ON schedule.id_hall = hall.id_hall
     WHERE id_user = $user_id
";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    echo "<h1 class='afisha'>МОИ БРОНИРОВАНИЯ</h1>";
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            echo"<div class='schedule'>";
            $name = $row["name_of_spectacle"];
            $age =$row["age_limit"];
            $date=  $row["date_spectacle"];
            $hall= $row["number_of_hall"];
            $price =$row["price"];
            $id_reservation = $row["id_reservation"] ;
            echo"<h1>$name</h1>";
            echo"<p>$age</p>";
            echo"<h4>Номер бронирования: $id_reservation</h4>";
            echo"<h4>ДАТА: $date</h4>";
            echo "<h6>Hall: $hall</h6>";
            echo "<h2>Price: $price</h2>";
            echo"<a class='login' href='delete_reservation.php?reservation=$id_reservation'>Удалить бронирование</a>";
            echo"</div>";
        }
    }
    else {echo "<h3>Данных нет</h3>";}
    // очищаем результат
    mysqli_free_result($result);
}


?>
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