<!--saisir_resultat.php
cette page sert à saisir le resultat d'une confrontation
-->

<html>

<head>
</head>

<body>

<?php
session_start();
include ('connect.php');
$dateCompet=$_POST['datecompet'];
$nomCompet=$_POST['nomcompet'];

if (isset($_POST['Ajouter'])) {
	if ($_POST['gagnant']==$_POST['perdant']) {
		echo "Erreur";
	}
	else{
		$connexion = fConnect("tuxa.sme.utc","5432","dbnf17p111","nf17p111",'ngp5HZBQ');
		$nomg = pg_escape_string($_POST['nomg']); 
	    	$nomp = pg_escape_string($_POST['nomp']);
		$scoreg = pg_escape_string($_POST['scoreg']); 
	    	$scorep = pg_escape_string($_POST['scorep']);
		$query = "UPDATE confrontation(gagnant, perdant, scoreGagnant, scorePerdant) VALUES('".$_POST['gagnant']."', '".$_POST['perdant']."', '".$_POST['scoreg']."', '".$_POST['scorep']."')";

		$resultat = pg_query($connexion,$query);
	}

}
else{
	$connexion = fConnect("tuxa.sme.utc","5432","dbnf17p111","nf17p111",'ngp5HZBQ');
	$query = "SELECT part1, part2 FROM confrontation WHERE nomCompetition=\"$_POST['nomcompet']\" AND dateCompetition=\"$_POST['datecompet']\"";
	$resultat = pg_query($Connexion,$query);
?>

<form method="POST" action="">
<SELECT NAME="gagnant">

<?php
	echo "<OPTION VALUE=\"part1\"> $row['part1'] </OPTION>";
	echo "<OPTION VALUE=\"part2\"> $row['part2'] </OPTION>";
?>

</SELECT>
<SELECT NAME="perdant">

<?php
	echo "<OPTION VALUE=\"part1\"> $row['part1'] </OPTION>";
	echo "<OPTION VALUE=\"part2\"> $row['part2'] </OPTION>";
?>

</SELECT>
<input type="text" name="scoreg">Score du gagnant :<br>
<input type="text" name="scorep" >Score du perdant :<br>

<input type="submit" name="Ajouter" value="Ajouter">
<?php
}
?>

</form>

</body>

</html>
