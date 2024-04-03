<?php
    setcookie("visited", "1", time() + 3600);

    $conn = mysqli_connect('localhost', 'root', '', 'egzamin');
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl6.css" />
    <title>Document</title>
</head>

<body>
    <header id="jeden">
        <h2>Odloty z lotniska</h2>
    </header>
    <header id="dwa">
        <img src="zad6.png" alt="logotyp" />
    </header>
    <section>
        <table>
            <h4>Tabela odlotów</h4>
            <tr>
                <th>lp</th>
                <th>numer rejsu</th>
                <th>czas</th>
                <th>kierunok</th>
                <th>status</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT id, nr_rejsu, czas, kierunek, status_lotu
        from odloty order by czas DESC");
            while ($row = mysqli_fetch_array($result)) { ?>

                <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['nr_rejsu']?></td>
                <td><?=$row['czas']?></td>
                <td><?=$row['kierunek']?></td>
                <td><?=$row['status_lotu']?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </section>
    <footer id="footer1">
        <a href="kw1.jpg" target="_blank">Pobierz obraz</a>
    </footer>
   

    <footer id="footer2">
        <p><?= isset($_COOKIE['visited']) ? "Miło nam że nas znowu odwiedziłeś" : "Dzień dobry! Sprawdź regulamin naszej strony" ?></p>
    </footer>
    <footer id="footer3">Autor:0000000000</footer>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>