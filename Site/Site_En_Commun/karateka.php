<!-- cette page sert a afficher des critere pour chercher un karateka
	et on affiche tous les karateka trouvé selon le critere et leur detaille
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
		Nom Karateka <input type="text" name="nom" value=""><br>
		Club<input type="text" name="club" value=""><br>
		Ceinture<input type="text" name="ceinture" value=""><br>
		dan<input type="text" name="dan" value=""><br>
        <input type="radio" name="tri" value='nom' id="" />Nom<br>
        <input type="radio" name="tri" value='age' id="" />Age<br>
        <input type="radio" name="tri" value='poids' id="" />Poids<br>
        <input type="radio" name="tri" value='nbWin' id="" />Nombre de Victoires<br>
        <input type="radio" name="tri" value='nbLoss' id="" />Nombre de Defaites<br>
		<input type="submit" name="submit" value="recherche ">
	</form>
	</div>


	<br><br><br>
	<table border='1' cellspacing='0'>
	<tr><td>Nom</td>
		<td>Nom Club</td>
		<td>Age</td>
		<td>Poids</td>
		<td>Taille</td>
		<td>Ceinture</td>
		<td>dan</td>
		<td>Nb Victoires</td>
		<td>Nb Defaites</td>
	</tr>

<?php
$query = "SELECT id, nom, nomclub, age, poids, taille, ceinture, dan,
			(SELECT COUNT(*) 
				FROM confrontation WHERE karateka.id = confrontation.gagnant) AS nbvict,
			(SELECT COUNT(*)
				FROM confrontation WHERE karateka.id = confrontation.perdant) AS nbloss 
			FROM karateka ";
		
if (isset($_POST['submit']))
{

	$nom = pg_escape_string($_POST['nom']);
    $club = pg_escape_string($_POST['club']); 
    $ceinture = pg_escape_string($_POST['ceinture']);
    $dan = pg_escape_string($_POST['dan']);
    if(isset($_POST['tri']))
    	$tri = $_POST['tri'];
    else $tri ="";
    
    
    if($club != ""){
	    $query = $query . "WHERE nomclub = '$club' ";
	    if($nom != "")
		    $query = $query . "AND nom = '$nom' ";
	    if($ceinture != "")
		    $query = $query . "AND ceinture = '$ceinture' ";
	    if($dan != "")
		    $query = $query . "AND dan = '$dan' "; 
		    
    }elseif($nom != ""){
		    $query = $query . "WHERE nom = '$nom' ";
	    if($ceinture != "")
		    $query = $query . "AND ceinture = '$ceinture' ";
	    if($dan != "")
		    $query = $query . "AND dan = '$dan' "; 
		    
    }elseif($ceinture != ""){
		    $query = $query . "WHERE ceinture = '$ceinture' ";
	    if($dan != "")
		    $query = $query . "AND dan = '$dan' "; 
		    
    }elseif($dan != "")
		    $query = $query . "WHERE dan = 'dan' ";
	        
	switch($tri){
		case "age":
			$query = $query . "ORDER BY age;";
		break;
		case "poids":
			$query = $query . "ORDER BY poids;";
		break;
		case "nbWin":
			$query = $query . "ORDER BY nbvict DESC;";
		break;
		case "nbLoss":
			$query = $query . "ORDER BY nbloss DESC;";
		break;
		default:
			$query = $query . "ORDER BY nom;";
		break;
	}



}
	$vQuery = @pg_query($idConnexion, $query) or die();	
	
	while($vResult  = pg_fetch_array($vQuery)){
		$id = $vResult['id'];
    	$nom = $vResult['nom'];
    	$nomClub = $vResult['nomclub'];
    	$age = $vResult['age'];
		$poids = $vResult['poids']; 
    	$taille = $vResult['taille'];
		$ceinture = $vResult['ceinture']; 
    	$dan = $vResult['dan'];
		$nbVict = $vResult['nbvict'];
		$nbDef = $vResult['nbloss'];

    echo "<tr>
		<td>$nom</td>
		<td>$nomClub</td>
		<td>$age</td>
		<td>$poids</td>
		<td>$taille</td>
		<td>$ceinture</td>
		<td>$dan</td>
		<td>$nbVict</td>
		<td>$nbDef</td>
    </tr>";
 	}
 	
 ?>
	</table>
	<br><br>
	<a href="index.html"">retour accueil</a>
	
</body>
</html>
