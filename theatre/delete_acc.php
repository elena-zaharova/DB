<?php
require_once 'connection_to_database.php';

$id=0;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$query = "SELECT * FROM ticket
        LEFT JOIN reservation
        ON ticket.id_reservation = reservation.id_reservation 
        LEFT JOIN user
        ON reservation.id_user = user.id_user
        WHERE user.id_user = '$id'";
$result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
if ($result)
{
     $rows = mysqli_num_rows($result); // количество полученных строк
     if(mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_array($result)) {
             $id_reservation = $row["id_reservation"];
             $id_ticket = $row["id_ticket"];
             $query2 = "DELETE ticket FROM ticket
                        WHERE id_ticket = '$id_ticket'";
             $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
             if($result2 )
             {
                 $query3 = "DELETE reservation FROM reservation
                            WHERE id_reservation = '$id_reservation'";
                 $result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
                 if($result3){
                     $query4 = "DELETE user FROM user
                                WHERE id_user = '$id'";
                     $result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link));
                     if(result4){
                         session_start();
                         session_destroy();
                         header("Location:login_form.php");
                     }
                 }
                 header("location:index.php");
             }
             else{
                 header("location:index.php");
             }
         }
     }
else {
    header("location:index.php");
}
}
    mysqli_free_result($result);

?>