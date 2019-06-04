<?php
require("confphp.php");
//добавление данных в таблице
if(isSet($_REQUEST["delete"])){
    $kask=$yhendus->prepare("DELETE FROM Klient WHERE KlientID=?");
    $kask->bind_param("i", $_REQUEST["delete"]);
    // "i" - int для поля id
    $kask->execute();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Заказы</title>
        <meta charset="utf8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
       <nav>
    <ul>

        <li><a href="Pagar.php">Заказы</a></li>
        <li><a href="TellimusAdmin.php">Добавить новую выпечку</a></li>
      <li><a href="tsaik_php.docx" download>Word File</a></li>    
    </ul>
    </nav>
      <h1>Members</h1>
        <div id="menyy">
            <?php
            // просмотр данных
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Имя</th>";
            echo "<th>Фамилия</th>";
            echo "<th>Номер телефона</th>";
             echo "<th>Номер заказа</th>";
            echo "<tr>";
            $kask=$yhendus->prepare("SELECT KlientID, Nimi, Perenimi, Telefoninumber, Zakaz FROM Klient ");
            //WHERE id=? - условие где id - произвольно выбранное значение
            $kask->bind_result($KlientID, $Nimi, $Perenimi,$Telefoninumber,$Zakaz );
            $kask->execute();
            while($kask->fetch())
            {
                echo "<tr>";
                echo "<th>".htmlspecialchars($KlientID)."</th>";
                echo "<th>".htmlspecialchars($Nimi)."</th>";
                echo "<th> ".htmlspecialchars($Perenimi)."</th>";
                echo "<th> ".htmlspecialchars($Telefoninumber)."</th>";
              echo "<th> ".htmlspecialchars($Zakaz )."</th>";
                echo "<th><a href='?delete=$id'>Delete</a></th>";
                echo "</tr>";

            }
            echo "</table>";
            ?>
        </div>
      <br>
     
    </body>
</html>
<?php
$yhendus->close();
?>
