<!--ce page est servi a ajouter les points des gategorie et des coup interdit pour chaque competition-->

<?php
session_start();
include ('connect.php');
if (isset($_POST['coupinterdit']))
{
	$comp=$_SESSION['comp'];
	$date=$_SESSION['compdate'];
	if (!isset($_POST['interdit'])){
		echo "tu doit choisir au moins un categorie de mouvement interdit à competition !<br>";

	}else{
	$interdit=$_POST['interdit'];
	$idConnecxion = fConnect();
	foreach($interdit as $cat){
		$query = "INSERT INTO coupsInterdits(nomCategorie, dateCompetition, nomCompetition) VALUES('" . $cat . "', '" . $date . "', '" . $comp . "')";
		$resultat =pg_query($idConnecxion,$query);
	}
    
	$query2= "SELECT * FROM coupsInterdits WHERE nomCompetition = '$comp' AND dateCompetition ='$date'";
	$coupinterdit=pg_query($idConnecxion,$query2);
	 if ($coupinterdit){
	 	while ($row = pg_fetch_assoc($coupinterdit)) { 
			echo $row['nomcategorie']."<br>";
			}
			echo "<a href=\"point.php\">ajouter point pour les coups </a><br>";
		}
		
	 else{
	 	echo "probleme with database";
	 }	
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
		echo "<input type=\"checkbox\" name=\"interdit[]\" value=\"".$row['nom']."\">".$row['nom']."<br>";
	}
?>
	<input type="submit" name="coupinterdit" value="ajouter ces coups interdit"><br>
	</form>

<?php	

}

?>