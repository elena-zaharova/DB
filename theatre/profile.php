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

<?php
require_once 'connection_to_database.php';

$user_id = $_SESSION["id"];

$query ="SELECT * FROM user WHERE id_user = $user_id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));



if($result)
{
$rows = mysqli_num_rows($result); // количество полученных строк

echo "<div class='spectacle'>";
    echo "<div class='cont'>";
        echo "<h1>ПРОФИЛЬ</h1>";
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $name = $row["name"];
            $date =$row["date_of_birth"];
            echo"<h2>ФИО: $name</h2></a>";
            echo"<p>Дата Рождения: $date</p>";
            echo"</div>";
        }}
        echo "</div>";
    echo "</div>";
    echo"<div class='tickets'>";
    //по резервациям
    echo"</div>";

// очищаем результат
mysqli_free_result($result);
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