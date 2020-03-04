<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'magazinvirtual');
/* connect to MySQL database */
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($conn === false){
 die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
 header("location: principala.php");
 exit();
}
// Include config file

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 // Check if username is empty
 if(empty(trim($_POST["username"]))){
 $username_err = "Please enter username.";
 } else{
 $username = trim($_POST["username"]);
 }

 // Check if password is empty
 if(empty(trim($_POST["password"]))){
 $password_err = "Please enter your password.";
 } else{
 $password = trim($_POST["password"]);
 }

 // Validate credentials
 if(empty($username_err) && empty($password_err)){
 // Prepare a select statement
 $sql = "SELECT id, username, password FROM users WHERE username = ?";

 if($stmt = $conn->prepare($sql)){
 // Bind variables to the prepared statement as parameters
 $stmt->bind_param("s", $param_username);

 // Set parameters
 $param_username = $username;

 // Attempt to execute the prepared statement
 if($stmt->execute()){
 // Store result
 $stmt->store_result();

 // Check if username exists, if yes then verify password
 if($stmt->num_rows == 1){
 // Bind result variables
 $stmt->bind_result($id, $username, $hashed_password);
 if($stmt->fetch()){
 if(password_verify($password, $hashed_password)){
 // Password is correct, so start a new session
 session_start();

 // Store data in session variables
 $_SESSION["loggedin"] = true;
 $_SESSION["id"] = $id;
 $_SESSION["username"] = $username;

 // Redirect user to welcome page
 header("location: principala.php");
 } else{
 // Display an error message if password is not valid
 $password_err = "The password you entered was not valid.";
 }
 }
 } else{
 // Display an error message if username doesn't exist
 $username_err = "No account found with that username.";
 }
 } else{
 echo "Oops! Something went wrong. Please try again later.";
 }
 }
if($username=='admin')
	header("location:admin.php");
 // Close statement
 $stmt->close();
 }

 // Close connection
 $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Login</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
 <style type="text/css">
 body
{
    
    background-color:#990033;
    font-size:15px;
    
   
}
img{ margin-left:50px;}
section{ display:flex;
    justify-content:space-between;}
.wrapper
{
    border: 20px solid black;
    background-color:#ffe6ee;
   position: absolute;
  width: 600px;
  height: 600px;
  top: 20%;
  bottom:80%;
  left: 50%;
  right:50%;
  margin: -100px 0 0 -300px;
  font-family:courier,monospace,weight:bold;
}




.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited
 {
    background-color: #8064A2 !important;
}

p a{ color:crimson;}

                  
.monotype{font-family:monotype corsiva,cursive; font-size:80px; color:black; margin:15px; }




 </style>
</head>
<body>
<p class="monotype" >Time4Wine</p>



<section>
                <div> <img src="img1.jpg"  > </div>
                <div> <img width="400" height="400 " src="img2.jpg"  > </div>
                
                
        </section>

      
 <div class="wrapper">
 <h2>Login</h2>
 <p>Please fill in your credentials to login.</p>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
 <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
 <label>Username</label>
 <input type="text" name="username" class="form-control" value="<?php echo $username;
?>">
 <span class="help-block"><?php echo $username_err; ?></span>
 </div>
 <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
 <label>Password</label>
 <input type="password" name="password" class="form-control">
 <span class="help-block"><?php echo $password_err; ?></span>
 </div>
 <div class="form-group">
 <input type="submit" class="btn btn-primary"  name=' login' value='Login'>
 </div>
 <p>Don't have an account? <a href="registration.php">Sign up now </a>.</p>
 </form>
 </div>
</body>
</html>