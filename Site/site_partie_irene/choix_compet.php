<!--choix_compet.php
cette page sert à choisir la compétition où s'est déroulée la confrontation dont on veut saisir le résultat
-->


<html>

<head>
</head>

<body>

	<?php
		session_start();
		include ('connect.php');
		$connexion = fConnect();
		$query = "SELECT date, nom FROM competition";
		$resultat =pg_query($connexion,$query);
	?>

	Choisissez la compétition :</br>

	<form method="POST" action="saisir_resultat.php">
	</SELECT>
	<SELECT NAME="comp">

	<?php
		while ($row = pg_fetch_array($resultat)){
			echo "<OPTION VALUE='".$row[date]."/".$row['nom']."'>".$row[date]."/".$row['nom']." </OPTION>";
			
		}
	?>


	<INPUT VALUE="Ok" name='choix' TYPE="SUBMIT">
	</FORM>

</body>

</html>
