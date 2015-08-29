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
$connexion = fConnect();

if (isset($_POST['Ajouter'])) {
	
		$gagnant = pg_escape_string($_POST['gagnant']); 
		$scoreg = pg_escape_string($_POST['scoreg']); 
	    $scorep = pg_escape_string($_POST['scorep']);
		$query = "UPDATE confrontation 
			SET gagnant = ".(int)$gagnant .", scoreGagnant = ".(int)$scoreg.", scorePerdant = ".(int)$scorep." 
			WHERE dateCompetition ='".$_SESSION['dateCompet']."'AND nomCompetition='".$_SESSION['nomCompet']."'AND  numeroTour=".$_SESSION['tour']."AND part1=".$_SESSION['part1']."AND part2=".$_SESSION['part2'];
		$resultat = pg_query($connexion,$query);
		if($resultat) {
			echo "resultat bien enregistré <br>";
			echo "<a href=\"connect_club.php\">retour page de club</a>";
		}
	

}
else if (isset($_POST['choix'])){
   	list($dateCompet, $nomCompet) = explode('/',$_POST['comp']);
   	//echo $dateCompet.$nomCompet;
   	$_SESSION['dateCompet']=$dateCompet;
   	$_SESSION['nomCompet']=$nomCompet;
      if($dateCompet&$nomCompet){
	$connexion = fConnect();
	$query = "SELECT numeroTour, part1, part2 FROM confrontation WHERE nomCompetition='".$nomCompet."' AND dateCompetition='".$dateCompet."'";
	$resultat = pg_query($connexion,$query);
?>
<form method="POST" action="">
<SELECT NAME="confrontation">

<?php
	while ($row = pg_fetch_array($resultat)){
		$query2 = "SELECT nom FROM karateka WHERE id = ".$row['part1'].";";
		$nom1 = pg_fetch_array(pg_query($connexion,$query2));
		$query2 = "SELECT nom FROM karateka WHERE id = ".$row['part2'].";";
		$nom2 = pg_fetch_array(pg_query($connexion,$query2));
	
		echo "<option value=\" ".$row[0]."/".$row['part1']."/". $row['part2']."\">Tour: ".$row[0]. " : " . $nom1['nom'] . " vs " . $nom2['nom'] . "</option>";
	}
?>
</SELECT>

<br>
<input name="confron" value="choose a confrontation" type="submit">
</form>
<?php
	}

		else {
		echo "date et nom de cometition non validé";
			}
    }
else if (isset($_POST['confron']))

{	list($_SESSION['tour'],$_SESSION['part1'],$_SESSION['part2'])= explode('/', $_POST['confrontation']);

// { 	$connexion = fConnect();
// 	$query = "SELECT part1, part2 FROM confrontation WHERE numeroTour = '".$_POST['confrontation']."' AND nomCompetition='".$_SESSION['nomCompet']."' AND dateCompetition='".$_SESSION['dateCompet']."'";
// 	//echo $query;
// 	$resultat = pg_query($connexion,$query);
?>
<form method="POST" action="">
gagnant : <SELECT NAME="gagnant">

<?php
	$query2 = "SELECT nom FROM karateka WHERE id = ".$_SESSION['part1'].";";
	$nom1 = pg_fetch_array(pg_query($connexion,$query2));
	$query2 = "SELECT nom FROM karateka WHERE id = ".$_SESSION['part2'].";";
	$nom2 = pg_fetch_array(pg_query($connexion,$query2));
	
	echo "<option value=\"" . $_SESSION['part1'] . "\">" . $nom1['nom'] . "</option>";
	echo "<option value=\"" . $_SESSION['part2'] . "\">" . $nom2['nom'] ."</option>";
?>

<br>
</SELECT>

<br>
Score du gagnant :<input type="text" name="scoreg"><br>
Score du perdant :<input type="text" name="scorep" ><br>

<input type="submit" name="Ajouter" value="Ajouter">


</form>
<?php
}	
?>



</body>

</html>
