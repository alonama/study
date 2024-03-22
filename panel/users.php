<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dane4";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}
?>
<html>

<head>
    <lang="pl">
        <meta charset="utf-8">
        <link rel="stylesheet" href="styl4.css" type=text/css>
</head>

<body>
    <header>
        <h3>Portal Społecznościowy - panel administratora</h3>
    </header>
    <section id=lewy>
        <h4>Użytkownicy</h4>
        <?php
        $result = $conn->query("select id, imie, nazwisko, rok_urodzenia, zdjecie from osoby limit 30");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row["id"] . ". " . $row["imie"] . " " . $row["nazwisko"] . ", " . (date("Y") - $row["rok_urodzenia"]) . " lat<br>";
            }
        } else {
            echo "0 results";
        }
        ?>
        <a href="settings.html">strona w trakcie budowy”</a>
    </section>
    <section id=prawy>
        <?php
        $userid="";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            $userid = (int)($_POST['userid']);
        ?>
        <form action="users.php" method="POST">
            <h4>Podaj id użytkownika</h4>
            <input type="number" name="userid" value="<?=$userid?>"/>
            <input class=styled type="submit" value="ZOBACZ">
        </form>
        <hr>
        <?php
        if ($userid != "" ) {
            $result = $conn->query("SELECT osoby.imie, osoby.nazwisko, osoby.rok_urodzenia, osoby.opis, osoby.zdjecie, hobby.nazwa from osoby, hobby where osoby.hobby_id= hobby.id and osoby.id=$userid");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
        <h2><?=$userid?>. <?=$row["imie"]?> <?=$row["nazwisko"]?></h2>
        <img src="<?=$row["zdjecie"]?>" alt="alt text"/><br>
        <p>Rok urodzenia: <?=$row["rok_urodzenia"]?></p>
        <p>Opis: <?=$row["opis"]?></p>
        <p>Hobby: <?=$row["nazwa"]?></p>
        <?php
                }
            } else {
                echo "0 results";
            }        
        }
        ?>

    </section>
    <footer>
        <h3>Stronę wykonał:00000000000</h3>
    </footer>

</body>

</html>
<?php
$conn->close();
?>