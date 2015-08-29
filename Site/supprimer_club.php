<!--ce page est servi à creer des nouveau club, et lui attributer des droit sur le BDD-->
<!--a la fin de page proposer une forme à sauter sur le page signin.php--> 
<?php
session_start();
?>

<html>
<head></head>
<body>
<h1> Supression club</h1>
<?php
if (isset($_GET['submit'])){
    echo "received get <br>";
    include ("connect.php");
    $idConnexion = fConnect();
    $nom = pg_escape_string($_GET['nom']); 
    $dirigeant = pg_escape_string($_GET['dirigent']); 
    $site = pg_escape_string($_GET['site']); 
    $query = "DELETE FROM club WHERE nom='".$nom."' AND coordonneesDirigeant='".$dirigeant."';";
    $result = pg_query($idConnexion,$query) or die("aucune entree trouvée");
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
Dirigent : <input type = 'text' name = 'dirigent'><br> 
<input type = 'submit' name= 'submit' value ='supprimer'>

</form>
