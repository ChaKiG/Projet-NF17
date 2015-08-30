<!--
// ce page est servi a chercher l'utilisateur dans BDD et confirmer son login
// tous les utilisateur type 'Club' connect à Base de donnee avec username: club password : club
// ils peuvent modifier ou creer des information si seulement elle est liée avec ce club 
// mais ces droit la sont pas attribué au niveau de postgresql, il faut l'en limité en php
-->
<?php
session_start()
?>

<html>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
</head>
<body>
<h1> Accueil</h1>
<form method ="POST" action="connect_club.php">
<?php
	if (isset($_SESSION["login"])) { 
	    header('Location: connect_club.php');
	}
	else {
		echo "<input type =\"text\" name =\"login\">login<br>";
		echo "<input type =\"text\" name =\"pwd\">mot de passe<br>";
	}
?>
	
	<input type = "submit" value ="sign in">

</form>
</body>
</html>



 
