<!--modifier_karateka.php

ce page est servi à modifier info d'un karateka de la club
ou ajouter un karateka dans le club.
-->
<?php
session_start();
$login=$_SESSION['login'];
$dirigeant=$_SESSION['dirigeant'];
include("connect.php");
$idConnecxion =fConnect("tuxa.sme.utc","5432","dbnf17p110","nf17p110",'vxNhGX3v');
    if (isset($_POST['submit'])) {
      
        // post to the same page with form below
        echo "modfiy post received <br>";

        echo $_POST['submit']; 
        // submit contains the id of karateka
        $query = "SELECT * FROM karateka where id =".$_POST['submit'];
        $result = pg_query($idConnecxion,$query); 
        $row= pg_fetch_array($result);
?>      
        <form method="POST" id="change">   
        <table>
        <tr>
                <td>nom</td>
                <td>age</td>
                <td>poids</td>
                <td>taille</td>
                <td>ceinture</td>
                <td>dan</td>
                <td>button</td>
        </tr>

        <?php
        
        echo "<tr>";
        echo "<input type =\"hidden\" name =\"id\" value =\"".$row['id']."\">";
        echo "<td><input type =\"text\" name =\"nom\" value =\"".$row['nom']."\"></td>";
        echo "<td><input type =\"text\" name =\"age\" value =\"".$row['age']."\"></td>";
        echo "<td><input type =\"text\" name =\"poids\" value =\"".$row['poids']."\"></td>";
        echo "<td><input type =\"text\" name =\"taille\" value =\"".$row['taille']."\"></td>";
        echo "<td><input type =\"text\" name =\"ceinture\" value =\"".$row['ceinture']."\"></td>";
        echo "<td><input type =\"text\" name =\"dan\" value =\"".$row['dan']."\"></td>";
        echo "<td><input type =\"submit\" name =\"change\" value =\"change\"></td>";
        echo "</tr>"

        


        ?>
        </table> 

        </form>
       
<?php


    }else{

        if (isset($_POST['change'])){
            $querystring = "UPDATE karateka set nom = '".$_POST['nom']."', age = '".$_POST['age']."', poids = '".$_POST['poids']."',taille = '".$_POST['taille']."',ceinture = '".$_POST['ceinture']."',dan = '".$_POST['dan']."' WHERE id = ".$_POST['id'];
            $query=pg_query($idConnecxion,$querystring); 

        }
        if(isset($_POST['ajouter'])){
             $querysqc="SELECT nextval('karateka_sqc') AS next";
             $nextstring=pg_query($idConnecxion,$querysqc); 
             $row=pg_fetch_array($nextstring);
             $querystring = "INSERT INTO karateka (nom,age,poids,taille,ceinture,dan,id,nomclub,coordonneesdirigeantclub)VALUES('".$_POST['nom']."', '".$_POST['age']."', '".$_POST['poids']."','".$_POST['taille']."','".$_POST['ceinture']."', '".$_POST['dan']."',".$row['next'].",'".$login."','".$dirigeant."')";
             $query=pg_query($idConnecxion,$querystring); 
        }
    

$querystring = "SELECT id, nom, age, poids, taille, ceinture, dan FROM karateka WHERE nomClub ='$login'";
$query = pg_query($idConnecxion,$querystring); 

?>
<form method="POST" id="karateka" action="">
<table>
<?php

while($row= pg_fetch_array($query))
{
?>
    <tr id="tablelist" align="left" height="30" 

        onMouseOver="this.bgColor='#01111b'; this.style.color='#FFF';" 

        onMouseOut="this.bgColor='#69F'; this.style.color='#000';" 

        bgColor='#69F'>

        

            <td><?php echo $row['id'] ?></td>

            <td><?php echo $row['nom'] ?></td>

            <td><?php echo $row['age'] ?></td>

            <td><?php echo $row['poids'] ?></td>

            <td><?php echo $row['taille'] ?></td>
            
            <td><?php echo $row['ceinture'] ?></td>
            
            <td><?php echo $row['dan'] ?></td>

            <td><?php echo "<input type='submit' name='submit' value='".$row['id']."'>"?></td>

        </tr>
        <br>
<?php   
}//while
// ajouter un karateka

?>      

</table>
</form>

<form name="ajouter" method="POST" id="ajouter">   
        <table>
        <tr>
                <td>id</td>
                <td>nom</td>
                <td>age</td>
                <td>poids</td>
                <td>taille</td>
                <td>ceinture</td>
                <td>dan</td>
                <td>button</td>
        </tr>

        <?php
        
        echo "<tr>";
        echo "<td><input type =\"text\" name =\"id\"></td>";
        echo "<td><input type =\"text\" name =\"nom\"></td>";
        echo "<td><input type =\"text\" name =\"age\"></td>";
        echo "<td><input type =\"text\" name =\"poids\"></td>";
        echo "<td><input type =\"text\" name =\"taille\"></td>";
        echo "<td><input type =\"text\" name =\"ceinture\" ></td>";
        echo "<td><input type =\"text\" name =\"dan\" ></td>";
        echo "<td><input type =\"submit\" name =\"ajouter\"></td>";
        echo "</tr>"

        


        ?>
        </table> 

</form>
<a href="connect_club.php">retour page de club</a>

<?php
} //else
?>

