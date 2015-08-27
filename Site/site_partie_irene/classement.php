<!--classement final d'un competition-->

<?php
//include('connect.php');
function classement($date, $nom) {

	$query= "SELECT c.gagnant, c.perdant FROM confrontation c, karateka k where dateCompetition = '$date' AND nomCompetition = '$nom' AND c.gagnant = k.id AND c.perdant = k.id order by c.numeroTour " ;
	//echo $query;
	$idConnecxion= fconnect();
	$resultat = pg_query($idConnecxion,$query);

	$row = pg_fetch_array($resultat);
	echo "gagnant : ".$row['c.gagnant']."deuxieme place : ".$row['c.perdant'];
}
?>