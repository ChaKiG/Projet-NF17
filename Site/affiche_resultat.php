<!--affiche_resultat.php
cette page sert à afficher les résultats de la compétition choisie
-->


<html>

<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

<?php
	session_start();
	include ('connect.php');
	echo "competition choisie : <br>". $_POST['comp']."<br><br>";
	list($dateCompet, $nomCompet) = explode('/',$_POST['comp']);
	$db = dbConnect();
	$sql = "SELECT part1, part2, numerotour FROM confrontation WHERE dateCompetition= :datecompet AND nomCompetition= :nomcompet";
    $values = array('datecompet' => $dateCompet, 'nomcompet' => $nomCompet);
    $query = $db->prepare($sql);
    $query->execute($values);
?>

Liste des confrontations :<br>
<table border='1' cellspacing='0'>
    <tr>
        <td>tour</td>
        <td>particpants</td>
    </tr>
    
    <?php
	while ($row = $query->fetch()){
		$sql = "SELECT K.nom AS nom, C.nom AS nomclub FROM karateka K, club C WHERE id = ".$row['part1']. " AND C.login = K.loginclub";
		$kara1 = $db->query($sql)->fetch();
		$sql = "SELECT nom FROM karateka WHERE id = ".$row['part2']. " AND C.login = K.loginclub";
		$kara2 = $db->query($sql)->fetch();
		echo "<tr>
                <td>". $row['numerotour']. "</td>
                <td>". $kara1['nom']. "(" . $kara1['nomclub']. ") vs ".$nom2['nom']. "(" . $kara1['nomclub']. ")</td></tr>";
	};
?>    
</table>
    
<?php
    $sql = "SELECT k.nom, MAX(c.numeroTour) FROM confrontation c, karateka k 
        WHERE dateCompetition= :datecompet 
        AND nomCompetition= :nomcompet
        AND c.gagnant=k.id";
    
    $values = array('datecompet' => $dateCompet, 'nomcompet' => $nomCompet);
    $query = $db->prepare($sql);
    $query->execute($values);

    echo "<br><br><br>";
    echo "karateka ayant gagné au dernier tour : <br>";
    while($row = $query->fetch())
        echo $row['nom']."<br>";
?>


</body>

</html>
