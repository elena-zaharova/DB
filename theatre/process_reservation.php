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
<?php

if (isset($_POST['count'])) {
    $count = $_POST['count'];
    if ($count == '') {
        unset($count);
    }
}

if (empty($count)) {

    echo "
			<div class='warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
    exit();
} else {
    if ($count > 6) {
        echo "
			<div class='warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>NOT VALID</b>
			</div>
		";
        exit();
    }

}
// подключаемся к базе
include("connection_to_database.php");

$id=0;
if(isset($_GET['id_schedule'])){
    $id = $_GET['id_schedule'];
}
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}

for($i = 0; $i < $count; ++ $i )
{
    $query ="INSERT INTO reservation VALUES(NULL,$id,$user_id)";
    $result = mysqli_query($link, $query);
    if ($result == 'TRUE') {
        $last_id = $link->insert_id;
        $price = 500.0;
        $query2 ="INSERT INTO ticket VALUES(NULL,'$price', $last_id)";
        $result2 = mysqli_query($link, $query2);
        if ($result2 == 'TRUE') {
            $process = "TRUE";
        }

    }
}

if($process == 'TRUE'){
    header("location:profile.php");

}else
    {
        echo"<p>Try again</p>";
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




