<!--affiche_resultat.php
cette page sert à afficher les résultats de la compétition choisie
-->


<html>

<head>
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
	echo $dateCompet.$nomCompet;
	$connexion = fConnect();
	$query = "SELECT part1, part2 FROM confrontation WHERE dateCompetition='".$dateCompet."' AND nomCompetition='".$nomCompet."'";

	//$query = "SELECT part1, part2 FROM confrontation WHERE dateCompetition=".$dateCompet." AND nomCompetition=".$nomCompet;
	$resultat = pg_query($connexion,$query);
?>

Liste des confrontations :

<?php
	while ($row = pg_fetch_array($resultat)){
		echo $row['part1']."-".$row['part2'];
		};
?>

Classement par karatéka :

1er : <?php
			classement($dateCompet,$nomCompet);

			// $query2 = "SELECT k.nom, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.gagnant=k.id"; //Le numeroTour le plus grand est celui de la finale
			// $resultat2 = pg_query($connexion,$query2);
			// $row= pg_fetch_array($resultat2);
			// echo $row['k.nom'];
		?>

2ème : <?php 
			// $query2 = "SELECT k.nom, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.perdant=k.id";
			// $resultat2 = pg_query($connexion,$query2);
			// $row= pg_fetch_array($result2);
			// echo $row['k.nom']; 
		?>

Classement par club :

1er : <?php 
			// $query3 = "SELECT k.nomClub, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.gagnant=k.id";
			// $resultat3 = pg_query($connexion,$query3);
			// $row= pg_fetch_array($result3);
			// echo $row['k.nomClub'];
		?>

2ème : <?php 
			// $query3 = "SELECT k.nomClub, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.gagnant=k.id";
			// $resultat3 = pg_query($connexion,$query3);
			// $row= pg_fetch_array($result3);
			// echo $row['k.nomClub'];
		?>

</body>

</html>
