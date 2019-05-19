<?php
require_once 'connection_to_database.php';

$id=0;
if(isset($_GET['reservation'])){
    $id = $_GET['reservation'];
}

$query = "SELECT * FROM ticket
        LEFT JOIN reservation
        ON ticket.id_reservation = reservation.id_reservation 
        WHERE reservation.id_reservation = '$id'";
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
                    header("location:profile.php");
                }
                header("location:profile.php");
            }
            else{
                header("location:profile.php");
            }
        }
    }
    else {
        header("location:profile.php");
    }
}
mysqli_free_result($result);

?>