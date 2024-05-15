<?php
$con = mysqli_connect('localhost', 'root', '', 'egzamin5');
if($_SERVER['REQUEST_METHOD']=='POST'){
    $wpis=mysqli_real_escape_string($con, $_POST['wpis']);
    mysqli_query($con, "UPDATE zadania set wpis = '$wpis' WHERE dataZadania = '2020-07-13'");
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl5.css">
    <title>Mój kalendarz</title>

</head>

<body>
    <section id="baner1">
        <img src="logo1.png" alt="Mój kalendarz">
    </section>
    <section id="baner2">
        <h1>KALENDARZ</h1>
        <?php
        $result = mysqli_query($con,  "select miesiac, rok  from zadania  where dataZadania = '2020-07-01'");
        if ($row = mysqli_fetch_array($result)) {
        ?>
            <h3>miesiąc: <?= $row['miesiac'] ?>, rok: <?= $row['rok'] ?></h3>
        <?php
        }
        ?>
    </section>
    <section id="glowny">
        <?php
        $result = mysqli_query($con, 'SELECT dataZadania, wpis from zadania WHERE miesiac="lipiec"');
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div><h5><?=$row['dataZadania']?> <br><?=$row['wpis']?></h5></div>
        <?php
        }
        ?>
    </section>
    <footer>
        <form action="kalendarz.php" method="post">
            dodaj wpis: <input type="text" name="wpis"> <input type="submit" value="DODAJ">
            <p>Stronę wykonał:000000000</p>

        </form>
    </footer>
</body>
<?php
mysqli_close($con)
?>

</html>