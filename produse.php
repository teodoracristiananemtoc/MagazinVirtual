<?php




session_start();
$connect=mysqli_connect('localhost','root','','magazinvirtual');





////////////// cos ////////
if(isset($_POST["add"])){
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
                    'item_quantity' => $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][$count]= $item_array;
                
            }
            
       }
       else{
           $item_array= array(
               'item_id' => $_GET["id_prod"],
               'item_name' => $_POST["hidden_name"],
               'item_price' => $_POST["hidden_price"],
               'item_quantity' => $_POST["quantity"]
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







<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body >


<div id="container">
		<div id="header">
        	
        </div>   
        
         <div id="menu" style="color:white;  margin-left:600px;">
        	<ul>
            	<li class="menuitem" ><a href="principal.php" style="font-size:25px">Home</a></li>
                <li class="menuitem"><a href="contact.php" style="font-size:25px">Contact</a></li>
                
                <li class="menuitem"><a href="cosb.php" style="font-size:25px">Cos cumparaturi</a></li>
                 <li class="menuitem"><a href="logout.php" style="font-size:25px">Iesire</a></li>
           
            </ul>
        </div>
        
        <div id="leftmenu">

       <div id="leftmenu_top"> <img  style="margin-left:-50px; margin-top :-30px"width="280%" src="tfff.jpg"> </div>

				<div id="leftmenu_main">    
                
           
                        
                <ul>
                     <li><a href="produse.php ">Produse</a></li>
                    <li><a href="oferta.php">Promotii</a></li>
                    <li><a href="cautare.php">Cautare</a></li>
					 <li><a href="dulci.php">Vinuri Dulci</a></li>
                      <li><a href=" seci.php">Vinuri Seci</a></li>
                  
                    
                   
                </ul>
</div>
                
                
              <div id="leftmenu_bottom"></div>
        </div>
        
        
        
        
		
            
     
            
        
   </div>
  
   
   
   
   
   <div id="content">
        
        
        <div id="content_top"></div>
        <div id="content_main">

 <?php
 // connectare bazadedate
 include("conectare.php");

 
 

 // se preiau inregistrarile din baza de date
 if ($result = $mysqli->query("SELECT * FROM produse  "))
 { // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
 {

 echo"<table style='margin-top:35px ; margin-left:400px; border-collapse:separate; border-spacing:30px 60px ;align:center; ' >";
 
 

 while ($row = $result->fetch_object())
 {
	 
echo" <form method='post' action='cosb.php?action=add&produs_id=$row->produs_id ' > 
	
 
 


 <td style='color:white'> $row->produs_nume  </td>
 
<td>
<td>

<td> <img width='100px' height='100px' src='$row->produs_imagine'></td>
<td>
<td >

<td style='color:white'> $row->produs_pret RON </td>

<td>
<td style='color:white'> $row->produs_descriere </td>
<td>

 
 <td> <input type='submit' target='_blank' name='adauga_in_cos'  class='btn btn-default' value='Adauga in cos' style='background-color:Black; border-color:DeepPink; color:DeepPink;' /> </td>
 <td>
 <td>
 <td> <input type='text' name='quantity' class='form-control' value='1' /> </td>
   <input type='hidden' name='hidden_name' value=' $row->produs_nume'  />
<input type='hidden' name='hidden_price' value=' $row->produs_pret'  /></tr>
<input type='hidden' name='hidden_stoc' value=' $row->stoc'  /></tr>

</form>";

		

 }
echo"</table> ";


 
 	 

 }
 

 
 // daca nu sunt inregistrari se afiseaza un rezultat de eroare


 else
 { echo "Error: " . $mysqli->error(); }}

 // se inchide
 $mysqli->close();

 ?>

 
          
      </div>
   </div>

   
 
</body>
</html>







