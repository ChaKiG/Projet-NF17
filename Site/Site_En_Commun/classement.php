<!--classement final d'un competition-->

<?php
//include('connect.php');
function classement($date, $nom) {

	$query= "SELECT gagnant  , perdant FROM confrontation  where dateCompetition = '$date' AND nomCompetition = '$nom' order by  numeroTour desc" ;
	//echo $query;
	$idConnecxion= fconnect();
	$resultat = pg_query($idConnecxion,$query);

	$row = pg_fetch_array($resultat);
	//var_dump($row);
	if($row['gagnant']== null){
		// resultat n'a pas ete saisi
		echo "le classement final n'est pas encore disponible! ";

	}else{
		$query2 = "SELECT nom FROM karateka WHERE id = ".$row['gagnant'];
		$nom1 = pg_fetch_array(pg_query($idConnecxion,$query2));
		$query2 = "SELECT nom FROM karateka WHERE id = ".$row['perdant'];
		$nom2 = pg_fetch_array(pg_query($idConnecxion,$query2));
		echo "gagnant : ".$nom1['nom']."deuxieme place : ".$nom2['nom'];

	}
	
}
?>