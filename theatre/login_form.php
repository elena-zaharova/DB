
<?php
require_once 'connection_to_database.php';
//Стартуем сессии
session_start();
header('Content-Type: text/html; charset=utf-8');
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
// Проверяем, пусты ли переменные логина и id пользователя
if (empty($_SESSION['e_mail']) or empty($_SESSION['id_user']))
{
    ?>
    <!--Если пусты, то выводим форму входа.-->
    <div style="border: 0px solid blue;
 position:relative; top:100px; left:400px; height:200px; width:300px;">

        <form action="check_user.php" method="post">
            <label>логин:</label><br/>
            <input name="email" type="text" size="30" maxlength="30"><br/>
            <label>пароль:</label><br/>
            <input name="pass" type="password" size="15" maxlength="15"><br/><br/>
            <input type="submit" value="войти"><br/><br/>
        </form>

        <a href="registration_form.php">регистрация</a>
    </div>
    <?php
}
else
{
    $login=$_SESSION['e_mail'];


    $query = "SELECT * FROM user WHERE e_mail = '$login'";
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result))
        {
            //Присваивание записей
            $name = $row["e_mail"];
        }
        }
    }

    echo "
<div align='center'
style='border: 0px solid blue; position:relative; top:100px; left:350px; height:100px; width:300px;'>

	<font color='green'>Здравствуйте: "."<font color='red'>".$name."</font>!</font>
      <a href='logout.php'>выйти</a> 
   <br/>

</div>";
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