<?php

session_start();

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
       </div>
       <div class="container">
           <div class="container-header">
               <h1 class="aboutt">Театр NO NAME</h1>
               <div class="about">
                   <img class="info" src="image/pic.jpg" align="left" alt="theatre">
                   <p>
                  Теа́тр (греч. θέατρον — основное значение — место для зрелищ,
                   затем — зрелище, от θεάομαι — смотрю, вижу) — зрелищный вид
                   искусства, представляющий собой синтез различных искусств — литературы,
                   музыки, хореографии, вокала, изобразительного искусства и других,
                   и обладающий собственной спецификой: отражение действительности,
                   конфликтов, характеров, а также их трактовка и оценка, утверждение
                   тех или иных идей здесь происходит посредством драматического действия,
                  главным носителем которого является актёр.
                   Родовое понятие «театр» включает в себя различные его виды:
                   драматический театр, оперный, балетный, кукольный, театр пантомимы и др.
                   Во все времена театр представлял собой искусство коллективное;
                   в современном театре в создании спектакля, помимо актёров и режиссёра
                   (дирижёра, балетмейстера), участвуют художник-сценограф, композитор, хореограф,
                   а также бутафоры, костюмеры, гримёры, рабочие сцены, осветители
                   </p>
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