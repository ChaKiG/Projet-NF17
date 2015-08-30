<!--classement final d'un competition-->

<?php
include('connect.php');

function classement($date, $nom) 
{
	$sql= "SELECT gagnant, perdant FROM confrontation  WHERE datecompetition = '$date' AND nomcompetition = '$nom' AND numerotour = MAX(numerotour)" ;
	$resultat = $db->query($sql);

	$row = $resultat->fetch();
	if($row['gagnant']== null){
		// resultat n'a pas ete saisi
        die("le classement final n'est pas encore disponible! ");
	}else{
        //on a seulement le dernier tour
		$sql = "SELECT nom FROM karateka WHERE id = ".$row['gagnant'];
		$nom1 = $db->query($sql)->fetch();
		$sql = "SELECT nom FROM karateka WHERE id = ".$row['perdant'];
		$nom2 = $db->query($sql)->fetch();
		echo "gagnant : ".$nom1['nom']."deuxieme place : ".$nom2['nom'];
	}
	
}
?>