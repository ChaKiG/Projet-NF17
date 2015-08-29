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
	$db = dbConnect();
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
$sql = "SELECT * FROM confrontation";
		
		
if (isset($_POST['submit']))
{
	$values = array('nomcompetition' => $_POST['nom_competition'], 'date' => $_POST['date']);
    if($_POST['participant'] !=""){
        $query = $db->prepare("SELECT id FROM KARATEKA WHERE nom = :parti");
        $query->execute(array('parti' => $_POST['participant']));
	    $row_id_participant =  $query->fetch();
		$participant = $row_id_participant['id'];
    }
    $values = array_filter($values);
    
    if(!empty($values)){
        $sql .= " WHERE " . key($values) . ' = :' . key($values);
        next($values);
        while(current($values)){
            $sql .= " AND ". key($values) . ' = :' . key($values);
            next($values);
        }
        if(isset($participant)){
            $sql .= " AND part1 = :participant OR part2 = :participant";
            $values['participant'] = $participant;
        }
    }else
        if(isset($participant)){
            $sql .= " WHERE part1 = :participant OR part2 = :participant";
            $values['participant'] = $participant;
        }
    
    if(isset($_POST['tri']) && in_array($_POST['tri'], array('nomcompetition', 'numerotour', 'date')))
    	$sql .= " ORDER BY " . $_POST['tri'];
    else $sql .= " ORDER BY date";
    
    $query = $db->prepare($sql);
    $query->execute($values);
    
}else
    $query = $db->query($sql);


    while($vResult  = $query->fetch()){
    	$nomCompet = $vResult['nomcompetition'];
    	$numTour = $vResult['numerotour'];
		$idPart1 = $vResult['part1']; 
    	$idPart2 = $vResult['part2'];
		$sGagnant = $vResult['scoregagnant']; 
    	$sPerdant = $vResult['scoreperdant'];
        
    	$date = new DateTime($vResult['date']);
        $date = $date->format('d/m/Y');;
	
		$part1 = $db->query("SELECT nom FROM karateka WHERE id = $idPart1;")->fetch();
		$part2 = $db->query("SELECT nom FROM karateka WHERE id = $idPart2;")->fetch();
		$nom_part1 = $part1['nom'];
    	$nom_part2 = $part2['nom'];


		if( $vResult['gagnant'] == NULL)
	    	$nom_gagnant = "";
		else{
			$idGagnant = $vResult['gagnant'];
			$gagnant = $db->query("SELECT nom FROM karateka WHERE id = $idGagnant;")->fetch();
			$nom_gagnant = $gagnant['nom'];
		}


    echo "<tr>
		<td>$nomCompet</td>
		<td>$numTour</td>
		<td>$date</td>
		<td>$nom_part1</td>
		<td>$nom_part2</td>
		<td>$nom_gagnant</td>
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
