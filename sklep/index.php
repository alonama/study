<!DOCTYPE html>
<html lang="pl">
<?php
$conn = mysqli_connect('localhost', 'root', '', 'sklep');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep dla uczniów</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <section id="baner">
        <h1>Dzisiejsze promocje naszego sklepu</h1>
    </section>
    <section id="lewy">

        <h2>Taniej o 30%</h2>
        <ol>
            <?php
            $result = mysqli_query($conn, "SELECT nazwa from towary WHERE promocja!=0");
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <li><?= $row['nazwa'] ?></li>
            <?php
            }
            ?>
        </ol>
    </section>
    <section id="srodkowy">
        <h2>Sprawdź cenę</h2>
        <?php
        $product = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST")
            $product = mysqli_real_escape_string($conn, $_POST['product']);
        ?>
        <form action="index.php" method="post">
            <select id="towary" name="product">
                <option value="Gumka do mazania" <?= $product == "Gumka do mazania" ? 'selected' : '' ?>>Gumka do mazania</option>
                <option value="Cienkopis" <?= $product == "Cienkopis" ? 'selected' : '' ?>>Cienkopis</option>
                <option value="Pisaki 60 szt." <?= $product == "Pisaki 60 szt." ? 'selected' : '' ?>>Pisaki 60 szt.</option>
                <option value="Markery 4 szt." <?= $product == "Markery 4 szt." ? 'selected' : '' ?>>Markery 4 szt.</option>
            </select>
            <input type="submit" value="SPRAWDŹ"><br>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $result = mysqli_query($conn, "select cena from towary where nazwa like '$product'");
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <div>cena regularna: <?=$row['cena']?><br>
                    cena w promocji 30%: <?=$row['cena']*0.7?> </div>
        <?php
            }
        }
        ?>
    </section>

    <section id="prawy">
        <h2>Kontakt</h2>
        <p>e-mail:<a href="bok@sklep.pl">bok@sklep.pl </a></p>
        <img src="promocja.png" alt="promocja">
    </section>
    <footer>
        <h4>Autor strony: 0000000000000</h4>
    </footer>
</body>
<?php
mysqli_close($conn);
?>

</html>