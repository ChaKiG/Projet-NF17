<!--ce page est servi à creer des nouveau club, et lui attributer des droit sur le BDD-->
<!--a la fin de page proposer une forme à sauter sur le page signin.php--> 
<?php
session_start();
?>

<html>
<head></head>
<body>
<h1>Creation :</h1>
<?php
	if (isset($_GET['submit'])){
		// post to the same page with form below
		echo "received get <br>";
		include ("connect.php");
		$idConnexion = fConnect();
		$nom = pg_escape_string($_GET['nom']); 
        $dirigeant = pg_escape_string($_GET['dirigeant']); 
        $site = pg_escape_string($_GET['site']); 
        $query = "INSERT INTO club(nom,coordonneesDirigeant, site) VALUES('" . $nom . "', '" . $dirigeant . "', '" . $site . "')";
        $result = pg_query($idConnexion,$query); 
        if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        }
        pg_close(); 
        header('Location: connect_admin.php');
        }
	else {}
	
?>
<form method ="GET" action="">
Nom: <input type = 'text' name ='nom'><br>
Dirigent : <input type = 'text' name = 'dirigeant'><br>
Site : <input type ='text' name = 'site'><br> 
<input type = 'submit' name= 'submit' value ='create account'>

</form>
