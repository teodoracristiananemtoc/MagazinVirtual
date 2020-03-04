<?php
 // conectare la baza de date database
 include("conectare.php");

 // se verifica daca id a fost primit
 if (isset($_GET['produs_id']) && is_numeric($_GET['produs_id']))
 {
 // preluam variabila 'id' din URL
 $produs_id = $_GET['produs_id'];

 // stergem inregistrarea cu ibstudent=$id
 if ($stmt = $mysqli->prepare("DELETE FROM produse "))
 {
 $stmt->bind_param("i",$produs_id);
 $stmt->execute();
 $stmt->close();
 }
 else
 {
 echo "ERROR: Nu se poate executa delete.";
 }
 $mysqli->close();
 echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"Vizualizare.php\">Index</a></p>";
?>