<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauracja Wszystkie Smakis</title>
</head>
<body>
Dodano rezerwację do bazy
<?php
$conn=mysqli_connect('localhost', 'root', '', 'baza');
$data=$_POST['data'];
$numer=$_POST['numer'];
$telefon=$_POST['telefon'];
$result=mysqli_query($conn, "Insert into rezerwacje ( data_rez, liczba_osob, telefon)
VALUES('$data', $numer, '$telefon')");
mysqli_close($conn);
?>
</body>
</html>