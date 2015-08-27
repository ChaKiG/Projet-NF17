<?php
session_start()
?>

<html>
<head></head>
<body>
<h1>Page Administrateur :</h1>
<?php
include('connect.php');
if (isset($_POST['login']) || isset($_SESSION['login'])){
        if (isset($_POST['login'])){
	    $login =$_POST['login'];
	    $password =$_POST['pwd'];
	    $idConnexion = fConnect();
	    $query = "SELECT login FROM authent WHERE login = '$login' AND password = '$password'";
	    $resultat = pg_query($idConnexion,$query); 
                if (!$result= pg_fetch_array($resultat)) { 
		    echo "pas inscrit<br>";
		    echo "<a href ='index.html'>Retour</a>";
                }else{
		    $_SESSION['login']=$_POST['login'];
		    $_SESSION['typecompte']="admin";
		}
        }
        if (isset($_SESSION['login'])){
	    if($_SESSION['typecompte'] == "admin"){
		echo "vous etes connecte avec login :".$_SESSION['login']."<br>";
		echo "<a href=\"creer_club.php\">creer un club</a><br>";
		echo "<a href=\"supprimer_club.php\">supprimer club</a><br>";
		echo "<a href=\"affiche_club.php\">voir clubs</a><br>";
		echo "<a href=\"deconnect.php\">se deconnecter</a><br>";
	    }else{
		echo "compte non administrateur<br>";
		echo "<a href=\"connect_club.php\">retour page club</a><br>";
		echo "<a href=\"deconnect.php\">deconnexion</a><br>";
	    }
	}
}
else {
        echo "<br>";
        echo "<a href=\"index.html\">pas bien de jouer les malins !</a>";
        echo "<br>";

}

?>
</body>
</html>