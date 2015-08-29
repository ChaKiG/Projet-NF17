<!-- cette page sert a afficher des critere pour chercher un karateka
	et on affiche tous les karateka trouvé selon le critere
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
		Nom Karateka <input type="text" name="nom" value=""><br>
		Club<input type="text" name="club" value=""><br>
		Ceinture<input type="text" name="ceinture" value=""><br>
		dan<input type="text" name="dan" value=""><br>
        <input type="radio" name="tri" value='nom' id="" />Nom<br>
        <input type="radio" name="tri" value='age' id="" />Age<br>
        <input type="radio" name="tri" value='poids' id="" />Poids<br>
        <input type="radio" name="tri" value='nbwin' id="" />Nombre de Victoires<br>
        <input type="radio" name="tri" value='nbloss' id="" />Nombre de Defaites<br>
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
$sql = "SELECT id, nom, nomclub, age, poids, taille, ceinture, dan,
			(SELECT COUNT(*) 
				FROM confrontation WHERE karateka.id = confrontation.gagnant) AS nbwin,
			(SELECT COUNT(*)
				FROM confrontation WHERE karateka.id = confrontation.perdant) AS nbloss 
			FROM karateka ";
		
if (isset($_POST['submit']))
{
    $values = array( 'nom' => $_POST['nom'], 'nomclub' => $_POST['club'], 'ceinture' => $_POST['ceinture'], 'dan' =>$_POST['dan']);
    $values = array_filter($values);
    if(!empty($values)){
        $sql .= 'WHERE ' . key($values) . ' = :' . key($values);
        next($values);
        while(current($values)){
            $sql.= ' AND ' . key($values) . ' = :' . key($values);
            next($values);
        }
        
    }

    if(isset($_POST['tri']) && in_array($_POST['tri'], array('nom', 'age', 'poids', 'nomclub', 'nbwin', 'nbloss'))){
    	$sql .= " ORDER BY " . $_POST['tri'];
        if ($_POST['tri'] == 'nbwin'|| $_POST['tri'] == 'nbloss')
            $sql .= " DESC";
    }
    else $sql .= " ORDER BY nom";
    
    $query = $db->prepare($sql);
    $query->execute($values);


}else{
    $query = $db->query($sql);
}
	while($vResult  = $query->fetch()){
		$id = $vResult['id'];
    	$nom = $vResult['nom'];
    	$nomClub = $vResult['nomclub'];
    	$age = $vResult['age'];
		$poids = $vResult['poids']; 
    	$taille = $vResult['taille'];
		$ceinture = $vResult['ceinture']; 
    	$dan = $vResult['dan'];
		$nbVict = $vResult['nbwin'];
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
