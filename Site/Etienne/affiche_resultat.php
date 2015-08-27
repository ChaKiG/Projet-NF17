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
$connexion = fConnect("tuxa.sme.utc","5432","dbnf17p111","nf17p111",'ngp5HZBQ');
$query = "SELECT part1, part2 FROM confrontation WHERE dateCompetition=".$_POST['datecompet']."AND nomCompetition=".$_POST['nomcompet'];
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
$query2 = "SELECT k.nom, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.gagnant=k.id"; //Le numeroTour le plus grand est celui de la finale
$resultat2 = pg_query($connexion,$query2);
$row= pg_fetch_array($resultat2);
echo $row['k.nom'];
?>

2ème : <?php 
$query2 = "SELECT k.nom, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.perdant=k.id";
$resultat2 = pg_query($connexion,$query2);
$row= pg_fetch_array($result2);
echo $row['k.nom']; 
?>

Classement par club :

1er : <?php 
$query3 = "SELECT k.nomClub, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.gagnant=k.id";
$resultat3 = pg_query($connexion,$query3);
$row= pg_fetch_array($result3);
echo $row['k.nomClub'];
?>

2ème : <?php 
$query3 = "SELECT k.nomClub, MAX(c.numeroTour) FROM confrontation c, karateka k WHERE c.gagnant=k.id";
$resultat3 = pg_query($connexion,$query3);
$row= pg_fetch_array($result3);
echo $row['k.nomClub'];
?>

</body>

</html>
