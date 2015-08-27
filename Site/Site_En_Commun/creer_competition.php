<!--creer_competition.php
ce page est servi à creer des competitions
et fait inscrire les participants aux confrontations dans page participer.php 
chaque fois on doit inscrire 2 personnes et on creer une confrontation avec.
on peut saisir les resultats au fur et au mesure

on recoit un post vient de connect_club.php
-->

<?php
session_start();
if (isset($_POST['submit']))
{
	include ('connect.php');
	$login= $_SESSION['login'];
	$idConnecxion = fConnect();
	$nom = pg_escape_string($_POST['nom']); 
    $date = pg_escape_string($_POST['date']);
    $_SESSION['comp']= $nom;
    $_SESSION['compdate']=$date;
    $site = pg_escape_string($_POST['site']); 
    $contact = pg_escape_string($_POST['cont']); 
    $type = pg_escape_string($_POST['type']); 
    $query = "INSERT INTO competition(date,nom,site,contact,typeCompetition,clubNom,clubCoordonneesDirigeant) VALUES('" . $date . "', '" . $nom . "', '" . $site . "'
    	, '" . $contact . "', '" . $type . "', '" . $_SESSION['login'] . "', '" . $_SESSION['dirigeant'] . "')";
	$resultat =pg_query($idConnecxion,$query);
	if ($resultat && $type == 'kumite')
	{
			echo $nom." competition est crée, et voila la liste de tous les competitions <br> ";
	 		echo "<a href=\"point_et_coup_interdit.php\">ajouter des coup interdit</a><br>";
	 		
	}
	else {
		?><a href="connect_club.php">retour page de club</a><br><?php
	}
	$query2= "SELECT * FROM competition WHERE clubNom = '$login'";
	$tous_competition=pg_query($idConnecxion,$query2);
	 if ($tous_competition){
	 	while ($row = pg_fetch_array($tous_competition)) {
			echo $row['nom']."_";
			echo $row['date']."<br>";
			}
	 }
	 else{
	 	echo "probleme with database";
	 }
	
	 
	 

}
else{

?>

<h1>creer une competition</h1>
<form method="POST" action="">
<!--post sur le meme page-->
	<input type="text" name="date" value="DD/MM/YYYY">DATE<br>
	<input type="text" name="nom" value="nom de competition">Nom<br>
	<input type="text" name="site" value="www.club.com">Site<br>
	<input type="text" name="cont" >contact<br>
	<input type="radio" name="type" value="kumite" checked>kumite
	<br>
	<input type="radio" name="type" value="kata">kata
	<br>
	<input type="radio" name="type" value="tameshi" checked>tameshi
	<br>
	<input type="radio" name="type" value="libre">libre	
	<br> 
	<input type="submit" name="submit" value="create competition">
</form>
<a href="connect_club.php">retour page de club</a>
<?php
} // else
?>
