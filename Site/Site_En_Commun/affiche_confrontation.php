<!--
	Permet d'afficher toutes les confrontations ou de les chercher par
			date
			nomCompetition
			DateConfrontation
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
		Nom Compétition <input type="text" name="nom_competition" value=""><br>
		Participant<input type="text" name="participant" value=""><br>
		Date confrontation<input type="date" name="date" ><br>
		Trier Par<br>
        <input type="radio" name="tri" value='nomcompetition' id="" />Nom Competition<br>
        <input type="radio" name="tri" value='numerotour' id="" />Numero de Tour<br>
        <input type="radio" name="tri" value='date'" id=""/>Date<br>
		<input type="submit" name="submit" value="recherche ">
	</form>
	</div>


	<br><br><br>
	<table border='1' cellspacing='0'>
	<tr><td>Nom de la Competition</td>
		<td>Numero de Tour</td>
		<td>date</td>
		<td>Participant 1</td>
		<td>Participant 2</td>
		<td>Gagnant</td>
		<td>Points gagnant</td>
		<td>points perdant</td>
	</tr>

<?php
$query = "SELECT * FROM CONFRONTATION ";
		
		
if (isset($_POST['submit']))
{
	$nomCompet = pg_escape_string($_POST['nom_competition']);
    $date = pg_escape_string($_POST['date']); 
    $participant = pg_escape_string($_POST['participant']);
    if(isset($_POST['tri']))
    	$tri = $_POST['tri'];
    else $tri ="";
    
    if($participant !=""){
	    $array_id_participant =  pg_fetch_array(pg_query($idConnexion, "SELECT id FROM KARATEKA WHERE nom = '$participant';"));
		$id_participant = $array_id_participant['id'];
   }
   else $id_participant = 0;
   
    
    if($nomCompet != ""){
	    $query = $query . "WHERE nomcompetition = '$nomCompet' ";
	    if($participant != "")
		    $query = $query . "AND (part1 = '$id_participant' OR part2 = '$id_participant') ";
	    if($date != "")
		    $query = $query . "AND date = '$date' "; 
		    
    }elseif($participant != ""){
		    $query = $query . "WHERE (part1 = '$id_participant' OR part2 = '$id_participant') ";
	    if($date != "")
		    $query = $query . "AND date = '$date' "; 
		    
    }elseif($date != "")
		    $query = $query . "WHERE date = '$date' "; 

	if($tri == "numerotour")
		$query = $query . "ORDER BY numerotour DESC;";
	elseif($tri != "")
		$query = $query . "ORDER BY $tri;";
}


	$vQuery = @pg_query($idConnexion, $query) or die();
	while($vResult  = pg_fetch_array($vQuery)){
    	$nomCompet = $vResult['nomcompetition'];
    	$date = $vResult['date'];
    	$numTour = $vResult['numerotour'];
		$idPart1 = $vResult['part1']; 
    	$idPart2 = $vResult['part2'];
		$sGagnant = $vResult['scoregagnant']; 
    	$sPerdant = $vResult['scoreperdant'];
	
		$array_part1 = pg_fetch_array(pg_query($idConnexion, "SELECT NOM FROM KARATEKA WHERE id = $idPart1;"));
		$array_part2 = pg_fetch_array(pg_query($idConnexion, "SELECT NOM FROM KARATEKA WHERE id = $idPart2;"));
		$part1 = $array_part1['nom'];
    	$part2 = $array_part2['nom'];


		if( $vResult['gagnant'] == NULL)
	    	$gagnant = "";
		else{
			$idGagnant = $vResult['gagnant'];
			$array_gagnant = pg_fetch_array(pg_query($idConnexion, "SELECT NOM FROM KARATEKA WHERE id = $idGagnant;"));
			$gagnant = $array_gagnant['nom'];
		}


    echo "<tr>
		<td>$nomCompet</td>
		<td>$numTour</td>
		<td>$date</td>
		<td>$part1</td>
		<td>$part2</td>
		<td>$gagnant</td>
		<td>$sGagnant</td>
		<td>$sPerdant</td>	
    </tr>";
 	}
 	
 ?>
	</table>
	<br><br>
	<a href="index.html"">retour accueil</a>
	
</body>
</html>
