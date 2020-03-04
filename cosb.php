

<?php



session_start();
$conn=mysqli_connect('localhost','root','','magazinvirtual');





if(isset($_POST["placeorder"]))
    {
        if(!empty($_SESSION["shopping_cart"]))
        {
            $produse='';
            $cantitate='';
            $suma=0;
            $data= date("Y-m-d H:i:s");
            $client=$_SESSION["username"];
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                $produse=$produse."  ".$values["item_name"];
                $cantitate=$cantitate."  ".$values["item_quantity"];
                $suma= $suma +($values["item_quantity"]* $values["item_price"]);
				
            }
        
        //insert
            if($stmt = $conn->prepare("INSERT INTO comenzi(produse, cantitate, pret, client, dataa) VALUES(?,?,?,?,?)"))
            {
				$stmt->bind_param("sssss", $produse,$cantitate,$suma,$client,$data);
				$stmt->execute();
                $stmt->close();
              //  echo'<script>alert("Comanda a fost plasata cu succes!")</script>';
                
                 header("Location:livrare.php");
            }
            else
            {
			echo "ERROR: Nu se poate plasa comanda."; }
            
			    
            
        }
		
		
		
		
		
		foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                $produs_id=$values["item_id"];
         $cant=$values['item_quantity'];
				$stocki=$values["item_stoc"];
				
		
			$stocki=$stocki-$cant;
			
       
		 
		if($stocki>$cant)
		{
			if ($stmt = $conn->prepare("UPDATE produse SET stoc=? WHERE
produs_id='".$produs_id."'"))
 {
 $stmt->bind_param("s",$stocki);
 $stmt->execute();
 $stmt->close();
		}// mesaj de eroare in caz ca nu se poate face update
		}
 else
			{echo "ERROR: nu se poate executa update.";}}
		
		
		
		
		
		
		
		
           // se inchide conexiune mysqli 
        $conn->close();
        
    }
////////////// cos //////// 
if(isset($_POST["adauga_in_cos"])){
       if( isset($_SESSION["shopping_cart"]))
       {
            $item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
            if(!in_array($_GET["produs_id"], $item_array_id))
            {
                $count= count($_SESSION["shopping_cart"]);
                $item_array= array(
                    'item_id' => $_GET["produs_id"],
                    'item_name' => $_POST["hidden_name"],
                    'item_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
					'item_stoc' => $_POST["hidden_stoc"],
                );
                $_SESSION["shopping_cart"][$count]= $item_array;
				
				
                
            }
            
       }
       else{
           $item_array= array(
               'item_id' => $_GET["produs_id"],
               'item_name' => $_POST["hidden_name"],
               'item_price' => $_POST["hidden_price"],
               'item_quantity' => $_POST["quantity"],
			   'item_stoc' => $_POST["hidden_stoc"]
			   
           );
           $_SESSION["shopping_cart"][0]= $item_array;
       }
    }

    if(isset($_GET["action"])){
        if($_GET["action"]== "delete")
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values){
                if($values["item_id"] == $_GET["produs_id"]){
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>alert("Produs inlaturat")</script>';
                }
            }
        }
    } 
	?>
	
	<html>
<head>
<style>
.scris{color:wheat;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#4d0019;">
<div style="clear:both"></div>
<br>
<h3 class="scris">Detalii comanda</h3><br>
<div class="table-responsive">
<table class="table table-bordered">
<tr>
<th class="scris" width="40%">Nume produs</th>
<th class="scris" width="10%">Cantitate</th>
<th class="scris" width="20%">Pret</th>
<th class="scris" width="15%">Total</th>
<th class="scris" width="5%">Actiune</th>
</tr>
<?php
if(!empty($_SESSION["shopping_cart"]))
{
    $total=0;
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
         ?>
         <tr class="scris">
         <td><?php echo $values["item_name"]; ?></td>
         <td><?php echo $values["item_quantity"]; ?></td>
         <td><?php echo $values["item_price"]; ?> RON</td>
         <td><?php echo number_format($values["item_quantity"]*$values["item_price"],2); ?> RON</td>
         <td><a href="cosb.php?action=delete&produs_id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Elimina</span></a></td> 
         </tr>
         <?php
         $total=$total +($values["item_quantity"]* $values["item_price"]);
    }
    ?>
    <tr class="scris">
    <td colspan="3" align="right"><b>TOTAL</b></td>
    <td align="right"><?php echo number_format($total,2); ?> RON</td>
    </tr>
	
		 <form action='cosb.php' method='post'>
		 
            <input type="submit" value="comanda" name="placeorder" style="background-color:Black; border-color:DeepPink; color:DeepPink;">
		 
		  </form>
		 

    <?php
    
}
?>

 
 
 

 

</table>
</div>
</body>
</html>