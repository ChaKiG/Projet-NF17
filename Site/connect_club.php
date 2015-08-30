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
	    $db = dbConnect();
	    $sql = "SELECT nom FROM club, authent WHERE club.login = authent.login AND nom = :nom AND password = :password";
	    $values = array('nom' => $_POST['login'], 'password' => $_POST['pwd']);
        $query = $db->prepare($sql);
        $query->execute($values);
	    if (!$query->fetch()) {
            echo "valeurs incorrectes<br>";
            echo "<a href ='index.html'>Retour à l'accueil</a>";
	    }else{
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['dirigeant'] = $_POST['dirigeant'];
            $_SESSION['typecompte'] = "club";
	    }
	}
    if (isset($_SESSION['login'])){
        if($_SESSION['typecompte'] == "club"){
            echo "vous etes connecte avec login :".$_SESSION['login'] ."<br>
                <a href=\"modifier_karateka.php\">ajouter/modifier un karateka</a><br>
                <a href=\"creer_competition.php\">ajouter une competition</a><br>
                <a href=\"participer.php\">inscrire un karateka a une competition</a><br>
                <a href=\"choix_compet.php\">saisir le resultat d'une confrontation?</a><br>
                <a href=\"affiche_confrontation.php\">voir confrontations</a><br>
                <a href=\"karateka.php\">voir karatekas</a><br>
                <a href=\"affiche_club.php\">voir clubs</a><br>
                <a href=\"choix_compet2.php\">voir classement des competitions</a><br>
                <a href=\"deconnect.php\">se deconnecter</a>";
        }else{
            echo "compte non club<br>
                <a href=\"connect_admin.php\">retour page admin</a><br>
                <a href=\"deconnect.php\">deconnexion</a><br>";
        }
    }
}
else {
        echo "<br><a href=\"index.html\">non connecté</a><br>";
}

?>
</body>
</html>