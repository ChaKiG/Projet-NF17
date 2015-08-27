<!--
	Permet d'afficher tous les clubs par nb competition
-->
<html>
<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php
	session_start();
	include ('connect.php');
	$idConnexion = fConnect();
?>

	<a href="index.html"">retour accueil</a>
	<br><br>

	<div style="border: solid 2px #000000;">
	<form method="POST" action="">
		<p> Rechercher :</p>
		Nom Club <input type="text" name="nom_club" value=""><br>
		Coordonnées <input type="text" name="coordonnees" value=""><br>
		Trier Par<br>
        <input type="radio" name="tri" value='nom' id="" />Nom Club<br>
        <input type="radio" name="tri" value='nbco' id="" />Nombre Competition<br>
        <input type="radio" name="tri" value='nbka'" id=""/>Nombre Karateka<br>
		<input type="submit" name="submit" value="recherche ">
	</form>
	</div>


	<br><br><br>
	<table border='1' cellspacing='0'>
	<tr><td>Nom du club </td>
		<td>Coordonnées </td>
		<td>Site Web </td>
		<td>Nb Competitions </td>
		<td>Nb Karateka </td>
	</tr>

<?php
$query = "SELECT C.nom, C.coordonneesdirigeant, C.site,
   (SELECT count(clubnom) FROM competition WHERE clubnom=C.nom) as nbco,
   (SELECT count(nomclub) FROM karateka WHERE nomclub=C.nom) as nbka
   FROM club C ";
		
		
if (isset($_POST['submit']))
{
	$nomClub = pg_escape_string($_POST['nom_club']);
    $coordonnees = pg_escape_string($_POST['coordonnees']); 
    if(isset($_POST['tri']))
    	$tri = $_POST['tri'];
    else $tri = "";
    
    if($nomClub != ""){
		$query = $query . "WHERE C.nom='$nomClub' ";
		if($coordonnees != "")
			$query = $query . "AND C.coordonnesdirigeant='$coordonnees' ";
	}
	else{
		if($coordonnees != "")
	    	$query = $query . "WHERE C.coordonneesdirigeant='$coordonnees' ";
	}
	if($tri == "nom")
			$query = $query . "ORDER BY nom ASC;";
	elseif($tri != "")
			$query = $query . "ORDER BY $tri DESC;";
		
}

	$vQuery = @pg_query($idConnexion, $query) or die();
	while($vResult  = pg_fetch_array($vQuery)){
    	$nomClub = $vResult['nom'];
    	$coo = $vResult['coordonneesdirigeant'];
    	$site = $vResult['site'];
		$nbCompet = $vResult['nbco'];
		$nbKa = $vResult['nbka'];

    echo "<tr>
		<td>$nomClub</td>
		<td>$coo</td>
		<td>$site</td>
		<td>$nbCompet</td>
		<td>$nbKa</td>	
    </tr>";
 	}
 	
 ?>
	</table>
	<br><br>
	<a href="index.html"">retour accueil</a>
	
</body>
</html>
