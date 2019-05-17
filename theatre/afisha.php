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

    $query ="
     SELECT *
     FROM spectacle
     LEFT JOIN schedule
     ON spectacle.id_spectacle = schedule.id_spectacle
     LEFT JOIN hall
     ON schedule.id_hall = hall.id_hall
     LEFT JOIN spectacle_x_genre
     ON spectacle.id_spectacle = spectacle_x_genre.id_spectacle
     LEFT JOIN genre
     ON genre.id_genre = spectacle_x_genre.id_genre
     WHERE spectacle.begin_date < CURRENT_DATE 
     AND spectacle.end_date > CURRENT_DATE 
     AND schedule.date_spectacle >= CURRENT_DATE 
     ORDER BY schedule.date_spectacle DESC
";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));



    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк

        echo "<div class='afisha'>";
        echo "<div class='cont'>";
        echo "<h1>АФИША</h1>";
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo"<div class='schedule'>";
                $name = $row["name_of_spectacle"];
                $age =$row["age_limit"];
                $photo =$row["photo_of_spectacle"];
                $bdate =$row["begin_date"];
                $edate = $row["end_date"];
                $date=  $row["date_spectacle"];
                $genre= $row["genre"];
                $hall= $row["number_of_hall"];
                $id = $row["id_schedule"];
                echo"<a href='one_spectacle.php'><h2>$name</h2></a>";
                echo"<img class='afishapic' src='$photo' align='left' alt='spectacle'>";
                echo"<p>$age</p>";
                echo"<p>С $bdate до $edate</p>";
                echo"<h4>ДАТА: $date</h4>";
                echo "<h6>$genre</h6>";
                echo "<h6>$hall</h6>";

                echo"<a class='login reservation' href='reservation.php?id=$id'>ЗАБРОНИРОВАТЬ</a>";
                echo"</div>";
            }}
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