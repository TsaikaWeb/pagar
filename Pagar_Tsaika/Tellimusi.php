<?php
require("confphp.php");
//добавление данных в таблице
if(isSet($_REQUEST["newhuman"]))
{
    $kask = $yhendus->prepare("INSERT INTO Klient( Nimi, Perenimi, Telefoninumber,Zakaz) VALUES(?,?,?,?) ");
    $kask->bind_param("sssi", $_REQUEST["Nimi"], $_REQUEST["Perenimi"], $_REQUEST["Telefoninumber"], $_REQUEST["Zakaz"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    $yhendus->close();
}
?>
<!DOCTYPE HTML>
<html>
  <script type="text/javascript">
function Input(){
login_ok = false;
user_name = "";
password = "";
user_name = prompt("Логин","");
user_name = user_name.toLowerCase();
password = prompt("Пароль","");
password = password.toLowerCase();
if (user_name=="login" && password=="pass") {
 login_ok=true;
 window.location="Pagar.php";
}
//if (user_name=="login2" && password=="pass2") {
 //login_ok=true;
 //window.location="pagar/.php";
//}

if (login_ok==false) alert("Неверный логин или пароль!");
}
</script>
    <head>
        <title>Registration</title>
        <meta charset="utf8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
     <div id="knopka">
       <form>
         <input type="button" value="Войти на сайт" onClick="Input()">
       </form>
       </div>
       <nav>
    <ul>
        <li><a href="Tellimusi.php">Заказать выпечку</a></li>
      <li><a href="tsaik_php.docx" download>Word File</a></li>    
         </ul>
    </nav>
        <h1>Добро пожаловать в пекарню</h1>
            
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
      <a href="?lisamine=jah">Заказать выпечку</a>
 
        <br>
        
            
          
               <?php
        if(isSet($_REQUEST["lisamine"])){
                ?>
            <form action="?">
                <input type="hidden" name="newhuman" value="jah">
                Имя:
                <input type="text" name="Nimi">
                <br>
                Фамилия:
                <input type="text" name="Perenimi">
                <br>
                Ваш Номер:
                <input type="text" name="Telefoninumber">
                <br>
                Номер Заказа:
                <input type="text" name="Zakaz">
                <br>                            
                <input type="submit" value="Заказать">
            </form>
            <?php
        }
  
        //while($kask->fetch())
        //{

          //  echo "<h2>".htmlspecialchars($pealkiri)."</h2>";
//            echo"<div>".htmlspecialchars($sisu)."</div>";
  //     }
        //htmlspecialchars - не исполняет html код, записанный <>
        //fetch() - овзвращает запрашиваемые из базы данных значения
        //while - цикл, который отображает все введенные в базу данных значения
        //
       ?>
                         </div>
      <br>
      

    </body>
</html>
<?php
$yhendus->close();
?>
