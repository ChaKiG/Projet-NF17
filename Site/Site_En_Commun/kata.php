<!--kata.php
Sert a afficher toutes les informations en rapport avec les katas
-->

<html>
<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <a href="index.html"">retour accueil</a><br><br>
    <table><tr>
	<td>Kata</td>;
	<td>Ordre mvt</td>;
	<td>movement</td>;
    </tr>
    <?php
	include ('connect.php');
	$connexion = fconnect();
	$query= "SELECT * from MvtKata ORDER BY nomkata, ordremouvement ASC";
	$resultat= pg_query($connexion,$query);
	while($row= pg_fetch_array($resultat))
	{
    ?>
    <tr>
	    <td><b><?php echo $row['nomkata']?></b></td>;
	    <td><?php echo $row['ordremouvement']?></td>;
	    <td><?php echo $row['nommouvement']?></td>;
    </tr>
    <?php
	}
    ?>
    </table>
    <br><br>
    <a href="index.html"">retour accueil</a>
</body>
</html>