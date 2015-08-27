<?php
session_start()
?>

<html>
<head></head>
<body>
<h1> connect_club</h1>
<?php
include('connect.php');
if (isset($_POST['login']) || isset($_SESSION['login'])){
        if (isset($_POST['login'])){
	$login =$_POST['login'];
        $dirigeant =$_POST['dirigeant'];
        $_SESSION['login']=$_POST['login'];
        $_SESSION['dirigeant']=$_POST['dirigeant'];
	$idConnecxion = fConnect();
	$querystring = "SELECT nom FROM club WHERE nom ='$login' AND coordonneesDirigeant = '$dirigeant'";
	$query = pg_query($idConnecxion,$querystring); 
                if (!$result= pg_fetch_array($query)) { 

                	echo "vous etes pas inscrit<br>";
                	echo "<a href ='acceuil.html'>Retour</a>";



                }
        }
        else {
        	$result=null;
		echo "vous etes connecte avec login :".$_SESSION['login'];
                echo "<br>";
                echo "<a href=\"modifier_karateka.php\">ajouter/modifier un karateka</a>";
                echo "<br>";
                echo "<a href=\"creer_competition.php\">ajouter une competition</a>";
                echo "<br>";
                echo "<a href=\"participer.php\">inscrire un karateka a une competition</a>";
                echo "<br>";
                echo "<a href=\"choix_compet.php\">saisir le resultat d'une confrontation?</a>";
                        }
	
}
else {

         echo "<br>";
        echo "<a href=\"index.html\">vous etes pas signin</a>";
        echo "<br>";

}

?>
</body>
</html>