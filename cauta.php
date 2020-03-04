<html>


<?php
include ("conectared.php");


?>

<head>

<title> magazinonline.ro </title>

</head>
<body style="background-color:#4d0019; color:white">



<form action='cauta.php' action='get'>
<input type='text' name='cauta' placeholder='Cauta produse'>
</form>


<h1>Produsele </h1>

<?php
if(isset($_GET['cauta']) && $_GET['cauta']!=''){

$cauta=$_GET['cauta'];


 $query=mysqli_query($conn,"select * from produse where produs_nume OR produs_categorie LIKE '%{$cauta}%'");
 

 
 while($row = mysqli_fetch_assoc($query)){
           echo "<img style='width:100px;height:100px' src='".$row['produs_imagine']."'><br>

        Nume: ".$row['produs_nume']."<br> 
		Pret: ".$row['produs_pret']."<br> 
		Descriere:".$row['produs_descriere']." <br> 
		
		Categorie: ".$row['produs_categorie']."";
		echo "<br> <form
		  action='cauta.php?produs_id=".$row['produs_id']."' method='post'>
		 <input type='submit' name='adauga_in_cos' value='Adauga in cos'>
		
       </form>";
  
		 
		 	 
}}
?>

</body>
</html>
