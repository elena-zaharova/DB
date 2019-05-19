<?php
session_start();

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

<?php
require_once 'connection_to_database.php';

$query ="SELECT * FROM spectacle";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));



if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    echo "<div class='content'>";
    echo "<div class='cont'>";
    echo "<div class='spectacle'>";
    echo "<h1 class='afisha'>СПЕКТАКЛИ</h1>";
    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $id =  $row["id_spectacle"];
        echo"<div id='$id' class='onespec'>";
        $name = $row["name_of_spectacle"];
        $age =$row["age_limit"];
        $photo =$row["photo_of_spectacle"];
        echo"<img class='phospec' src='$photo' alt='spectacle'>";
        echo"<a href='one_spectacle.php?id=$id '><h2>$name</h2></a>";
        echo"<p>$age</p>";
        echo"</div>";
    }}
    echo "</div>";
    echo "</div>";
    echo "</div>";
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