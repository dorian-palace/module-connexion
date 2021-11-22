<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root','root');
//connexion BDD




?>
	<html>
	   <head>
	      <title>Modification profil</title>
	      <meta charset="utf-8">
	   </head>
	   <body>
	      <div align="center">
	         <h2>Modifier votre profil</h2>
	         <br /><br />
	         <form method="POST" action="">
	            <input type="text" name="newlogin" placeholder="login" />
                <input type="text" name="newprenom" placeholder="prenom" />
                <input type="text" name="newnom" placeholder="nom" />
	            <input type="password" name="newpassword" placeholder="password" />
	            <br /><br />
	            <input type="submit" name="modification" value="Modifier !" />
	         </form>
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