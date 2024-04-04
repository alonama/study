<!DOCTYPE html>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'egzamin_pilkarz');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=Б, initial-scale=1.0">
    <link rel="stylesheet" href="styl2.css" />
    <title>Document</title>
</head>

<body>
    <header>
        <h3>Reprezentacja Polski w piłce nożnej</h3>
        <img src="obraz1.jpg" alt="reprezentacja">
    </header>
    <div id="lewy">
        <?php 
         $pozycja=0;
         if($_SERVER['REQUEST_METHOD']=='POST'){
            $pozycja=htmlspecialchars($_POST['pozycja']);
         }
        ?>
        <form action="liga.php" method="post">
            <select name="pozycja">
                <option value="1" <?= $pozycja==1?'selected':'' ?>>Bramkarze</option>
                <option value="2" <?= $pozycja==2?'selected':'' ?> >Obrońcy</option>
                <option value="3" <?=$pozycja==3?'selected':'' ?>>Pomocnicy</option>
                <option value="4" <?=$pozycja==4?'selected':''  ?>>Napastnicy</option>
            </select>
            <input type="submit" value="Zobacz">
        </form>
        <img src="zad2.png" alt="piłka">
        <p>Autor:000000000</p>

    </div>


    <div id="prawy">
        <ol>
            <?php
           
            $result = mysqli_query($conn, "SELECT imie, nazwisko FROM zawodnik where pozycja_id=$pozycja");
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <li><?=$row['imie']. " ".$row['nazwisko']?></li>
            <?php
            }
            ?>

        </ol>
    </div>
    <div id="glowny">
        <h3>Liga mistrzów</h3>
    </div>
    <div id="liga">
        <?php
        $result = mysqli_query($conn, "SELECT liga.zespol, liga.punkty, liga.grupa from liga order by punkty DESC");
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="druzyna">
                <h2><?= $row['zespol'] ?></h2>
                <h1><?= $row['punkty'] ?></h1>
                <p>grupa: <?= $row['grupa'] ?></p>
            </div>
        <?php
        }
        ?>

    </div>

</body>

</html>
<?php
mysqli_close($conn);
?>