<?php

session_start();
$conn=mysqli_connect('localhost','root','','magazinvirtual');





if(isset($_POST["co"]))
    {
        
            
            $client=$_SESSION["username"];
			$email=$_POST['email'];
			$telefon=$_POST['telefon'];
			$adresa=$_POST['adresa'];
           
        
        //insert
            if($stmt = $conn->prepare("INSERT INTO livrare (client,email,telefon,adresa) VALUES(?,?,?,?)"))
            {
				$stmt->bind_param("ssss", $client,$email,$telefon,$adresa);
				$stmt->execute();
                $stmt->close();
              //  echo'<script>alert("Comanda a fost plasata cu succes!")</script>';
                
                 header("Location:comanda.php");
            }
            else
            {
                echo "ERROR: Nu se poate plasa comanda."; 
            }
            
        }
		
           // se inchide conexiune mysqli 
        $conn->close();
        
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Livrare</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
body
{
    
    background-color:#4d0019;
    font-size:15px;
    
   
}
.wrapper
{
    border:solid white 30px;
    background-color:white;
   position: absolute;
  width: 600px;
  height: 1000px;
  top: 20%;
  bottom:80%;
  left: 50%;
  right:50%;
  margin: -100px 0 0 -300px;
  font-family:courier,monospace,weight:bold;
}
.monotype{font-family:monotype corsiva,cursive; font-size:60px; color:white; margin:15px; }
.auten{text-align:center; }


</style>
</head>
<body>
<p class="monotype" align="left">Time4Wine</p>
<div class="wrapper">
<h2 class="auten">LIVRARE</h2><br>
<form >
<pre><input type="radio" name="livrare" value="posta_romana"><b>Posta romana                                  19,00 RON</b><br>7-10 zile lucratoare<br><br>
<input type="radio"  name="livrare" value="fan_courier"><b>Fan Courier                                   25,00 RON</b><br>3-4 zile lucratoare<br></pre>
</form><br>

<form  action='livrare.php' method='post'>

Nume:<br><input class="form-control" type="text" name="nume" placeholder="nume"><br><br>
Prenume:<br><input class="form-control" type="text" name="prenume" placeholder="prenume"><br><br>
Adresa:<br><input class="form-control" type="text" name="adresa" placeholder="adresa"><br><br>
E-mail:<br><input class="form-control" type="text" name="email" placeholder="e-mail"><br><br>
Telefon:<br><input class="form-control" type="text" name="telefon" placeholder="telefon"><br>
<input type="radio" name="plata" value="ramburs"><b>Plata se va face ramburs</b><br><br>
<input type="submit" value="comanda" name="co" >
</form>

</div>
</body>
</html>  
           