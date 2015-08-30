<!--choix_compet2.php
cette page sert à choisir la compétition dont on veut avoir les résultats
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
		$sql = "SELECT date, nom FROM competition";
		$query= $db->query($sql);
	?>

	Choisissez la compétition :</br>

	<form method="POST" action="affiche_resultat.php">
	</SELECT>
	<SELECT NAME="comp">
	<?php
		while ($row = $query->fetch())
			echo "<OPTION VALUE='".$row[date]."/".$row['nom']."'>".$row[date]."/".$row['nom']." </OPTION>";
	?>
	<INPUT VALUE="Ok" name='choix' TYPE="SUBMIT">
	</FORM>

</body>

</html>
