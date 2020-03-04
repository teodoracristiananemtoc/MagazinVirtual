<?php
 include("conectare.php");
 if (isset($_POST['submit']))
 {
 // preluam datele de pe formular
  $produs_id = htmlentities($_POST['produs_id'], ENT_QUOTES);
 $produs_nume = htmlentities($_POST['produs_nume'], ENT_QUOTES);
 $produs_pret = htmlentities($_POST['produs_pret'], ENT_QUOTES);
 $produs_descriere = htmlentities($_POST['produs_descriere'], ENT_QUOTES);
$produs_stare = htmlentities($_POST['produs_stare'], ENT_QUOTES);
 // verificam daca sunt completate
 if ( $produs_id == '' || $produs_nume == '' || $produs_pret == ''||$produs_descriere==''||$produs_stare=='')
 {
 // daca sunt goale se afiseaza un mesaj
 $error = 'ERROR: Campuri goale!';

 } else {
 // insert
 if ($stmt = $mysqli->prepare("INSERT into produse (produs_id, produs_nume, produs_pret, produs_descriere,produs_stare)VALUES (?,?, ?, ?, ?)"))
 {
 $stmt->bind_param("ssdsi",$produs_id, $produs_nume, $produs_pret,$produs_descriere,$produs_stare);
 $stmt->execute();
 $stmt->close();
 }
 // eroare le inserare
 else
 {
 echo "ERROR: Nu se poate executa insert.";
 }

 }
 }

 // se inchide conexiune mysqli
 $mysqli->close();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head> <title><?php echo "Inserare inregistrare"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if ($error != '') {
 echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error. "</div>";} ?>
<form action="" method="post">
 <div>
 <strong>Id: </strong> <input type="text" name="produs_id" value=""/><br/>
<strong>Nume: </strong> <input type="text" name="produs_nume" value=""/><br/>
<strong>Pret: </strong> <input type="text" name="produs_pret" value=""/><br/>
<strong>Descriere: </strong> <input type="text" name="produs_descriere" value=""/><br/>
<strong>Stare: </strong> <input type="text" name="produs_stare" value=""/> <br/>
<input type="submit" name="submit" value="Submit" />
<a href="Vizualizare.php">Index</a>
</div></form></body></html>