<?php
require("confphp.php");
if(isSet($_REQUEST["uusrida"])) {
    $kask = $yhendus->prepare("INSERT INTO Pagar(Nimetus,Hind,Number) VALUES (?,?,?)");
    $kask->bind_param("ssi", $_REQUEST["Nimetus"], $_REQUEST["Hind"], $_REQUEST["Number"] );
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    $yhendus->close();
}
//удаление конкретной записи
if(isSet($_REQUEST["kustutamine"])){
    $kask=$yhendus->prepare("DELETE FROM Pagar WHERE PagarID=?");
    $kask->bind_param("i", $_REQUEST["kustutamine"]);
    // "i" - int для поля id
    $kask->execute();
}
?>
<!DOCTYPE HTML>
<html lang="et">
<head>
    <title>Parties</title>
    <meta charset="utf-8">
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
   
    <div >
        <form action="?" id="form1">
            <input type="hidden" name="uusrida" value="jah">
            Название выпечки:
            <input type="text" name="Nimetus">
            <br>
            Цена:
            <input type="text" name="Hind">            
            <br>
            Номер:
            <input type="text" name="Number">            
            <br>
            <input type="submit" value="Подтвердить">
        </form>
          <div id="menyy">
          <h3>Меню для заказа</h3>
            <?php
            // просмотр данных
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Название выпечки</th>";
            echo "<th>Цена</th>";
            echo "<th>Номер</th>";
            
            echo "<tr>";
            $kask=$yhendus->prepare("SELECT PagarID, Nimetus, Hind, Number FROM Pagar ");
            //WHERE id=? - условие где id - произвольно выбранное значение
            $kask->bind_result($PagarID, $Nimetus, $Hind, $Number );
            $kask->execute();
            while($kask->fetch())
            {
                echo "<tr>";
                echo "<th>".htmlspecialchars($PagarID)."</th>";
                echo "<th>".htmlspecialchars($Nimetus)."</th>";
                echo "<th> ".htmlspecialchars($Hind)."</th>";
                echo "<th> ".htmlspecialchars($Number)."</th>";
                echo "</tr>";

            }
            echo "</table>";
            ?>
        </div>
      <br>
      
    </div>
    </body>
</html>
<?php
$yhendus->close();
?>