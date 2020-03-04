<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
 <title>Vizualizare Inregistrari</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 </head>
 <body>
 <h1>Inregistrarile din tabela datepers</h1>
 <p><b>Toate inregistrarile din datepers</b</p>
 <?php
 // connectare bazadedate
 include("conectare.php");
 // se preiau inregistrarile din baza de date
 if ($result = $mysqli->query("SELECT * FROM produse  "))
 { // Afisare inregistrari pe ecran
 if ($result->num_rows > 0)
 {
 // afisarea inregistrarilor intr-o table
 echo "<table border='1' cellpadding='10'>";

 // antetul tabelului
 echo
"<tr><th>ID</th><th>Nume</th><th>Pret</th><th>Categorie</th><th>Descriere</th><th></th><th></th></t
r>";

 while ($row = $result->fetch_object())
 {
 // definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->produs_id . "</td>";
 echo "<td>" . $row->produs_nume . "</td>";
echo "<td>" . $row->produs_pret . "</td>";
echo "<td>" . $row->produs_categorie . "</td>";
echo "<td>" . $row->produs_descriere . "</td>";
echo "<td>" . $row->stoc. "</td>";

 echo "<td><a href='update.php?produs_id=" . $row->produs_id .
"'>Modificare</a></td>";
 echo "<td><a href='Stergere.php?produs_id=" . $row->produs_id .
"'>Stergere</a></td>";
 echo "</tr>";
 }

 echo "</table>";
 }
 // daca nu sunt inregistrari se afiseaza un rezultat de eroare
 else
 {
 echo "Nu sunt inregistrari in tabela!";
 }
 }
 // eroare in caz de insucces in interogare
 else
 { echo "Error: " . $mysqli->error(); }

 // se inchide
 $mysqli->close();
 ?>
 <a href="Inserare.php">Adaugarea unei noi inregistrari</a>
 <a href= "stergere.php" > Stergere completa </a>
 </body>
</html>
