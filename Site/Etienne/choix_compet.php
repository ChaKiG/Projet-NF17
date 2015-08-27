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
$connexion = fConnect("tuxa.sme.utc","5432","dbnf17p111","nf17p111",'ngp5HZBQ');
$query = "SELECT date, nom FROM competition";
$resultat =pg_query($connexion,$query);
?>

Choisissez la compétition :</br>

<form method="POST" action="saisir_resultat.php">

</SELECT>
<SELECT NAME="datecompet">

<?php
while ($row = pg_fetch_array($resultat)){
	echo "<OPTION VALUE=\"$resultat[date]\"> $row['date'] </OPTION>";
	}; 
}
?>

</SELECT>

<SELECT NAME="nomcompet">

<?php
while ($row = pg_fetch_array($resultat)){
	echo "<OPTION VALUE=\"$resultat[nom]\"> $row['nom'] </OPTION>";
	}; 
}
?>


<INPUT VALUE="Ok" TYPE="SUBMIT">

</FORM>

</body>

</html>
