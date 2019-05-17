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
include("connection_to_database.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
// проверка на существование пользователя с таким же логином
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






