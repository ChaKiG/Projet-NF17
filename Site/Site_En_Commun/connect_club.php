<?php
session_start()
?>

<html>
<head></head>
<body>
<h1> Page de gestion Club</h1>
<?php
include('connect.php');
if (isset($_POST['login']) || isset($_SESSION['login'])){
        if (isset($_POST['login'])){
	    $login =$_POST['login'];
	    $dirigeant =$_POST['dirigeant'];
	    $idConnecxion = fConnect();
	    $querystring = "SELECT nom FROM club WHERE nom ='$login' AND coordonneesDirigeant = '$dirigeant'";
	    $query = pg_query($idConnecxion,$querystring); 
	    if (!$result= pg_fetch_array($query)) { 
		echo "vous etes pas inscrit<br>";
		echo "<a href ='index.html'>Retour</a>";
	    }else {
		$_SESSION['login']=$_POST['login'];
		$_SESSION['dirigeant']=$_POST['dirigeant'];
		$_SESSION['typecompte']="club";
	    }
	}
        if (isset($_SESSION['login'])){
	  if($_SESSION['typecompte'] == "club"){
	    echo "vous etes connecte avec login :".$_SESSION['login'];
	    echo "<br>";
	    echo "<a href=\"modifier_karateka.php\">ajouter/modifier un karateka</a>";
	    echo "<br>";
	    echo "<a href=\"creer_competition.php\">ajouter une competition</a>";
	    echo "<br>";
	    echo "<a href=\"participer.php\">inscrire un karateka a une competition</a>";
	    echo "<br>";
	    echo "<a href=\"choix_compet.php\">saisir le resultat d'une confrontation?</a>";
	    echo "<br>";
	    echo "<a href=\"affiche_confrontation.php\">voir confrontations</a>";
	    echo "<br>";
	    echo "<a href=\"karateka.php\">voir karatekas</a>";
	    echo "<br>";
	    echo "<a href=\"affiche_club.php\">voir clubs</a>";
	    echo "<br>";
	    echo "<a href=\"choix_compet2.php\">voir classement des competitions</a>";
	    echo "<br>";
	    echo "<a href=\"deconnect.php\">se deconnecter</a>";
	    }else{
		echo "compte non club<br>";
		echo "<a href=\"connect_admin.php\">retour page admin</a><br>";
		echo "<a href=\"deconnect.php\">deconnexion</a><br>";

	    }
      }
}
else {
        echo "<br>";
        echo "<a href=\"index.html\">non connecté</a>";
        echo "<br>";

}

?>
</body>
</html>