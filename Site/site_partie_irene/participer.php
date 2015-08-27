<!--ce page est dedie a inscrire les karatekas de ce club aux confrontation de tous les competition
Hypothese est que on ajoute toujours deux participant ensemble, et on creer une confrontation, et on lui specifié 
le numero de tour(je prend hypothese , maximum 4).
-->

<?php
session_start();
include('connect.php');
$login=$_SESSION['login'];


// traiter le post si il y une subbmit depuis le form  en bas, creer une confrontation

if (isset($_POST['participer'])) {
	$idConnecxion = fConnect("tuxa.sme.utc","5432","dbnf17p110","nf17p110",'vxNhGX3v');
	$part1 = pg_escape_string($_POST['part1']); 
    $part2 = pg_escape_string($_POST['part2']); 
    if ($part2 ===$part1){

    	echo "vous devez pas inscrire la meme personne deux fois dans competition!";
    	echo "<a href=\"participer.php\">retourner au page d'inscrire</a>";

    }
    else
    {
    list($comp, $date_competition) = explode('/',$_POST['comp']);
    $comp = pg_escape_string($comp); 
    $date_competition = pg_escape_string($date_competition); 
    $tour = pg_escape_string($_POST['tour']); 
    $date_comfontation = pg_escape_string($_POST['date_comfontation']); 
    $query = "INSERT INTO confrontation(date, dateCompetition, nomCompetition, numeroTour, part1, part2) VALUES('" . $date_comfontation . "', '" . $date_competition . "', '" . $comp . "'
    	, " . (int)$tour . ", " . (int)$part1 . ", " . (int)$part2. ")";
	$resultat =pg_query($idConnecxion,$query);
	$query2= "SELECT * FROM confrontation WHERE date = '$date_comfontation'";
	$confrontation=pg_query($idConnecxion,$query2);
		if ($confrontation){
		 	while ($row = pg_fetch_array($confrontation)) {
				echo $row['part1']."_";
				echo $row['part2']."<br>";
				}

		}	
		 else{
	 	echo "probleme with database";
	 	}
    }
   
	 


}
?>



<!--form pour s'inscrire et post sur le meme page-->
<form action="" method="POST">
<table>
	<tr>
		<td>participant1</td>
		<td>participant2</td>
		<td>competition</td>
		<td>numero_tour</td>
		<td>date_confrontation</td>
	</tr>
	<tr>
	<?php
	$idConnecxion = fConnect("tuxa.sme.utc","5432","dbnf17p110","nf17p110",'vxNhGX3v');
	$query = "SELECT id,nom FROM karateka WHERE nomclub ='$login'";
	$qpart1 =pg_query($idConnecxion,$query);
	
	?>
	<td>
	<select name="part1">
	<?php
	$comp='';
	
	while($part1 = pg_fetch_array($qpart1)){
		echo "<option value=\"".$part1['id']."\">".$part1['id']."	".$part1['nom']."</option>";
	}
	
	?>
	</select>
	</td>
	<td>
	<select name="part2">
	<?php
	$qpart1 =pg_query($idConnecxion,$query);
	while($part1= pg_fetch_array($qpart1)){
		echo "<option value=\"".$part1['id']."\">".$part1['id']."	".$part1['nom']."</option>";
	}
	?>
	</select>	
	</td>
	<td>
	<select name="comp">
	<?php
	$querycomp = "SELECT date,nom FROM competition";
	$qcomp =pg_query($idConnecxion,$querycomp);
	while($comp = pg_fetch_array($qcomp)){
		echo "<option value=\"".$comp['nom']."/".$comp['date']."\">".$comp['date']."	".$comp['nom']."</option>";
	}

	?>
	</select>
	</td>

	<td><input type="text" name="tour" value="1"></td>
	<td><input type="text" name="date_comfontation" value="DD/MM/YYYY"></td>
	</tr>
</table>
<input type="submit" name="participer" value="inscrire!">	
</form>

<br><a href="connect_club.php">retour au page de club</a><br>

