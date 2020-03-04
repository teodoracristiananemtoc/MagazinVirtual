<?php // connectare bazadedate
include("conectare.php");
//Modificare datelor
// se preia id din pagina vizualizare
 if (!empty($_POST['produs_id']))
 { if (isset($_POST['submit']))
 { // verificam daca id-ul din URL este unul valid
 if (is_numeric($_POST['produs_id']))
 { // preluam variabilele din URL/form
 $produs_id = $_POST['produs_id'];
 $produs_nume = htmlentities($_POST['produs_nume'], ENT_QUOTES);
 $produs_pret = htmlentities($_POST['produs_pret'], ENT_QUOTES);
 $produs_descriere = htmlentities($_POST['produs_descriere'], ENT_QUOTES);
 $produs_categorie = htmlentities($_POST['produs_categorie'], ENT_QUOTES);
 // verificam daca numele, prenumele, an si grupa nu sunt goale
 if ($produs_nume == '' || $produs_pret == ''||$produs_descriere=='' || $produs_categorie=='')
 { // daca sunt goale afisam mesaj de eroare
 echo "<div> ERROR: Completati campurile obligatorii!</div>";
 }else { // daca nu sunt erori se face update
if ($stmt = $mysqli->prepare("UPDATE produse SET produs_nume=?,produs_pret=?,produs_descriere=?, produs_categorie=? WHERE
produs_id='".$produs_id."'"))
 {
 $stmt->bind_param("sdss",$produs_nume, $produs_pret,$produs_descriere,$produs_categorie);
 $stmt->execute();
$stmt->close();
 }// mesaj de eroare in caz ca nu se poate face update
 else
 {echo "ERROR: nu se poate executa update.";}
 }
 }
 // daca variabila 'id' nu este valida, afisam mesaj de eroare
 else
 {echo "id incorect!";}
 }}?>
<html> <head><title> <?php if ($_GET['produs_id'] != '') { echo "Modificare inregistrare"; } ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head>
<body>
<h1><?php if ($_GET['produs_id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
 echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error. "</div>";} ?>
<form action="" method="post">
 <div>
 <?php if ($_GET['produs_id'] != '') { ?>
 <input type="hidden" name="produs_id" value="<?php echo $_GET['produs_id']; ?>" />
 <p>ID: <?php echo $_GET['produs_id'];
if ($result = $mysqli->query("SELECT * FROM produse where produs_id='".$_GET['produs_id']."'"))
 {
if ($result->num_rows > 0)
{ $row = $result->fetch_object();?></p>
<strong>Nume: </strong> <input type="text" name="produs_nume" value="<?php echo $row->produs_nume;
?>"/><br/>
 <strong>Pret: </strong> <input type="text" name="produs_pret" value="<?php echo $row->produs_pret; ?>"/><br/>
<strong>Descriere: </strong> <input type="text" name="produs_descriere" value="<?php echo $row->produs_descriere; ?>"/><br/>
<strong>categorie: </strong> <input type="text" name="produs_categorie" value="<?php echo $row->produs_categorie;}}}?>"/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="Vizualizare.php">Index</a>
</div></form></body> </html>
