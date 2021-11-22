<?php
session_start();
$serveur = "localhost";
$dbname = "moduleconnexion";
$userbdd = "root";
$pass = "root";

try{ 
    //Connexion BDD 
    $bdd = new PDO("mysql:host=$serveur;dbname=$dbname",$userbdd,$pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




}//try


catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  
?>
	<html>
	   <head>
	      <title>Modification profil</title>
	      <meta charset="utf-8">
	   </head>
	   <body>
	      <div align="center">
              <h2><?php echo $user['prenom']; ?></h2>
	         <h2>Modifier votre profil</h2>
	         <br /><br />
	         <form method="POST" action="">
	            <input type="text" name="newlogin" placeholder="login" value="<?php echo $user ?>" /><br /><br />
                <input type="text" name="newprenom" placeholder="prenom" value="" /><br /><br />
                <input type="text" name="newnom" placeholder="nom" /><br /><br />
	            <input type="password" name="newpassword1" placeholder="password" /><br /><br />
                <input type="password" name="newpassword2" placeholder="password" />
	            <br /><br />
	            <input type="submit" name="modification" value="Modifier !" />
	         </form>
             <a href="index.php">Accueil</a>
             <a href="deconnexion.php">Déconnexion</a>
	         <?php
	         if(isset($erreur)) {
	            echo '<font color="red">'.$erreur."</font>";
	         }
	         ?>
	      </div>
	   </body>
	</html>

<?php

?>