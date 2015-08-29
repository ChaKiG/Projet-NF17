<!--affiche_resultat.php
cette page sert à afficher les résultats de la compétition choisie
-->


<html>

<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

<?php
	session_start();
	include ('connect.php');
	include ('classement.php');
	echo $_POST['comp']."<br>";
	list($dateCompet, $nomCompet) = explode('/',$_POST['comp']);
	$dateCompet = pg_escape_string($dateCompet);
	//$dateCompet = date('Y-m-d',$dateCompet); 
	//echo $dateCompet.$nomCompet;
	$connexion = fConnect();
	$query = "SELECT part1, part2 FROM confrontation WHERE dateCompetition='".$dateCompet."' AND nomCompetition='".$nomCompet."'";


	//$query = "SELECT part1, part2 FROM confrontation WHERE dateCompetition=".$dateCompet." AND nomCompetition=".$nomCompet;
	$resultat = pg_query($connexion,$query);
?>

Liste des confrontations :<br>

<?php
	while ($row = pg_fetch_array($resultat)){
		$query2 = "SELECT nom FROM karateka WHERE id = ".$row['part1'];
		$nom1 = pg_fetch_array(pg_query($connexion,$query2));
		$query2 = "SELECT nom FROM karateka WHERE id = ".$row['part2'];
		$nom2 = pg_fetch_array(pg_query($connexion,$query2));

		echo $nom1['nom']." vs ".$nom2['nom']."<br>";
		};
?>

Classement par karatéka :

 <?php
			classement($dateCompet,$nomCompet);

			// $query2 = "SELECT k.nom, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.gagnant=k.id"; //Le numeroTour le plus grand est celui de la finale
			// $resultat2 = pg_quesry($connexion,$query2);
			// $row= pg_fetch_array($resultat2);
			// echo $row['k.nom'];
		?>


</body>

</html>
