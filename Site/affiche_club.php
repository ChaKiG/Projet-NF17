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
	$db = dbConnect();
?>

	<a href="index.html">retour accueil</a>
	<br><br>

	<div style="border: solid 2px #000000;">
	<form method="POST" action="">
		<p> Rechercher :</p>
		Nom Club <input type="text" name="nom" value=""><br>
		Coordonnées <input type="text" name="telephone" value=""><br>
		Trier Par<br>
        <input type="radio" name="tri" value='nom' id="" />Nom Club<br>
        <input type="radio" name="tri" value='nbco' id="" />Nombre Competition<br>
        <input type="radio" name="tri" value='nbka' id=""/>Nombre Karateka<br>
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
$sql = "SELECT C.nom, C.telephone, C.site,
   (SELECT count(nomclub) FROM competition WHERE nomclub=C.nom) as nbco,
   (SELECT count(nomclub) FROM karateka WHERE nomclub=C.nom) as nbka
   FROM club C";
		
		
if (isset($_POST['submit']))
{
	$values = array('nom' => $_POST['nom'], 'telephone' => $_POST['telephone']);
    $values = array_filter($values);
    if(!empty($values)){
        $sql .= ' WHERE C.' . key($values) . ' = :' . key($values);
        if(isset($values[1]))
            $sql .= ' AND C.' . key($values) . ' = :' . key($values);
    }
    
    if(isset($_POST['tri']) && in_array($_POST['tri'], array('nom', 'telephone', 'nbco', 'nbka'))){
    	$sql .= " ORDER BY " . $_POST['tri'];
        if ($_POST['tri'] == 'nbco'|| $_POST['tri'] == 'nbka')
            $sql .= " DESC";
    }
    else $sql .= " ORDER BY nom";
    
    $query = $db->prepare($sql);
    $query->execute($values);
    
		
}else
	$query = $db->query($sql);    


	while($row  = $query->fetch()){
    	$nomClub = $row['nom'];
    	$coo = $row['telephone'];
    	$site = $row['site'];
		$nbCompet = $row['nbco'];
		$nbKa = $row['nbka'];

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
