<!DOCTYPE html>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'dane2');

$nazwa = "";
$cena = "";
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    $nazwa = htmlspecialchars($_POST['nazwa']);
    $cena = htmlspecialchars($_POST['cena']);

    $result = mysqli_query(
        $conn,
        "INSERT INTO produkty(rodzaje_id, producenci_id, nazwa, ilosc, opis, cena, zdjecie)
     values(
         (SELECT id from rodzaje where nazwa='owoce'),
        (SELECT id FROM producenci where nazwa='warzywa-rolnik'),
         '$nazwa', 10, '', $cena, 'owoce.jpg')"
    );
}
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styl2.css" />
</head>
<body>
    <header id="jeden">
        <h1>Internetowy sklep z eko-warzywami</h1>
    </header>
    <header id="dwa">
        <ol>
            <li>warzywa</li>
            <li>owoce</li>
            <li><a href="https://terapiasokami.pl">soki</a></li>
        </ol>
    </header>
    <br />
    <section>
        <?php
        $result = mysqli_query($conn, "SELECT nazwa, ilosc, opis, cena, zdjecie FROM Produkty where Rodzaje_id=1 or Rodzaje_id=2");
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div>
                <img src="<?= $row['zdjecie'] ?>" />
                <h5><?= $row['nazwa'] ?></h5><br>
                <p>Opis: <?= $row['opis'] ?></p>
                <p>na stanie: <?= $row['ilosc'] ?></p>
                <h2><?= $row['cena'] ?></h2>

            </div>
        <?php
        }
        ?>
    </section>
    <footer>
        <form action="sklep.php" method="POST">
            Nazwa: <input type="text" name="nazwa" value="<?= $nazwa ?>">
            Cena: <input type="text" name="cena" value="<?= $cena ?>">
            <input type="submit" value="Dodaj produkt">
        </form>
        Stronę wykonał:000000000
    </footer>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>