<?php
 // conectare la baza de date database
 
 $mysqli=mysqli_connect('localhost','root','','magazinvirtual');
$resulti = $mysqli->query("DELETE FROM produse  ");
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

