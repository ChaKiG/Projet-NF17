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
        $db = dbConnect();
        $sql = "SELECT * from MvtKata ORDER BY nomkata, ordremouvement ASC";
        $query = $db->query($sql);
        while($row = $query->fetch()){
            echo "<tr>
                <td><b>" .$row['nomkata'] . "</b></td>;
                <td>" .$row['ordremouvement']. "</td>;
                <td>" .$row['nommouvement']. "</td>;
            </tr>";
	   }
    ?>
    </table>
    <br><br>
    <a href="index.html"">retour accueil</a>
</body>
</html>