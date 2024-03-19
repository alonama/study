<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wedkowanie";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("connection failed:" . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="utf-8" />
  <link href="styl_1.css" type="text/css" rel="stylesheet" />
</head>

<body>
  <header>
    <h1>Portal dla wędkarzy</h1>
  </header>
  <section id="lewy1">
    <h3>Ryby zamieszkujące rzeki</h3>
    <ol>
      <?php
      $result = $conn->query("select r.nazwa, l.akwen, l.wojewodztwo from ryby as r, lowisko as l where r.id= l.ryby_id and l.rodzaj=3");
      if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()){
          echo "<li>" . $row["nazwa"] . " pływa w rzece " . $row["akwen"] . ", " . $row["wojewodztwo"] . "</li>";
        }
      } else {
        echo "0 results"; 
      }
      ?>
    </ol>
  </section>
  <section id="prawy">
    <img src="ryba1.jpg" />
    <br>
    <a href="ryba1.jpg">Pobierz Kwerendy</a>
  </section>
  <section id="lewy2">
    <h3>Ryby drapieżne naszych wód</h3>
    <table>
      <tr>
        <th>L.p.</th>
        <th>Gatunek</th>
        <th>Występowanie</th>
      </tr>
      <?php 
        $result = $conn->query("SELECT id, nazwa, wystepowanie from ryby where styl_zycia=1");
        if ($result->num_rows > 0) {
          $lp=1;
          while($row=$result->fetch_assoc()){
      ?>
            <tr>
              <td><?=$lp?></td>
              <td><?=$row["nazwa"]?></td>
              <td><?=$row["wystepowanie"]?></td>
            </tr>
      <?php
            ++$lp;
          }
        }
      ?>
    </table>
  </section>

  <footer>
    Stronę wykonał:000000000
  </footer>
</body>

</html>
<?php
$conn->close();
?>