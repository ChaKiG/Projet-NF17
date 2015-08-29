<!--ce page est servi a ajouter les points  pour chaque competition-->

<?php
session_start();
include ('connect.php');
if (isset($_POST['point']))
{
	$comp=$_SESSION['comp'];
	$date=$_SESSION['compdate'];
	$idConnecxion = fConnect();
	$querycat= "SELECT nom  from Categorie where nom NOT IN  (SELECT nomCategorie from coupsInterdits  where dateCompetition ='".$_SESSION['compdate']."'AND nomCompetition = '".$_SESSION['comp']."' AND nomCategorie IS NOT NULL)";
	$resultat =pg_query($idConnecxion,$querycat);

	foreach ($_POST as $key => $value) {

		if ($key != 'point'){
			$query = "INSERT INTO Points(nomCategorie, dateCompetition, nomCompetition, points) VALUES('" . $key . "', '" . $date . "', '" . $comp . "', ".$value.")";
			$resultat = pg_query($idConnecxion,$query);
			echo "ajouter<br>";
		}else{
			echo "point<br>";
		}

	}

	// while ($row=pg_fetch_array($resultat)){
	// 	$cat=(string)$row['nom'];
	
	// 	//(array_key_exists("\"".$cat."\"", $_POST))
	// 	if(array_key_exists("un_autre_cat", $_POST))
	// 	echo $cat."<br>";
	// 	// if (isset($_POST['un_autre_cat'])){
	// 	// 	echo $cat.$_POST['{$cat}']."s<br>";

	// 	// 	//$query = "INSERT INTO Points(nomCategorie, dateCompetition, nomCompetition, points) VALUES('" . $cat . "', '" . $date . "', '" . $comp . "', ".$_POST["$cat"].")";

	// 	// }
		
	// }
	
    
	$query2= "SELECT * FROM Points WHERE nomCompetition = '$comp' AND dateCompetition ='$date'";
	$point=pg_query($idConnecxion,$query2);
	 if ($point){
	 	while ($row = pg_fetch_assoc($point)) { 
			echo $row['nomcategorie'].":".$row['points']." points <br>";
			}
			echo "<a href=\"connect_club.php\">retour au page de connexion </a><br>";
		}
		
	 else{
	 	echo "probleme with database";
	 }	
	

	
	 

}
else{
	echo "ajouter des coups interdit pour cette competition!".$_SESSION['comp']."  ".$_SESSION['compdate']." <br>";
	$idConnecxion = fConnect();
	$querycat= "SELECT nom  from Categorie where nom NOT IN  (SELECT nomCategorie from coupsInterdits  where dateCompetition ='".$_SESSION['compdate']."'AND nomCompetition = '".$_SESSION['comp']."' AND nomCategorie IS NOT NULL)";
	$resultat =pg_query($idConnecxion,$querycat);
?>
	<form method="POST" action="">
<?php

	while ($row=pg_fetch_array($resultat)){
	?><input type ="number" name =<?php echo $row['nom']."<br>";?><?php echo $row['nom']."<br>";
	}
?>
	<input type="submit" name="point" value="ajouter des points"><br>
	</form>

<?php	

}

?>