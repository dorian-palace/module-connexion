<?php
session_start();
$servname = 'localhost';
$dbname = 'dorian-palace_moduleconnexion';  // log de connexion à la bdd 
$user = 'moduleconnexion';
$mdp ='moduleconnexion';

try{ 
    //Connexion BDD 
    $bdd = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	if(isset($_SESSION['id'])){
		$requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
		$requser->execute(array($_SESSION['id']));
		$user = $requser->fetch();

		if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login'])
		{
			$newlogin = htmlspecialchars($_POST['newlogin']);
			$insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
			$insertlogin->execute(array($newlogin, $_SESSION['id']));
			header('Location: profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom'])
		{
			$newprenom = htmlspecialchars($_POST['newprenom']);
			$insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
			$insertprenom->execute(array($newprenom, $_SESSION['id']));
			header('Location: profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom'])
		{
			$newnom = htmlspecialchars($_POST['newnom']);
			$insertnom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
			$insertnom->execute(array($newnom, $_SESSION['id']));
			header('Location: profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newpassword1']) AND !empty($_POST['newpassword1']) AND isset($_POST['newpassword2']) AND !empty($_POST['newpassword2'])) {
			$password1 = sha1($_POST['newpassword1']);
			$password2 = sha1($_POST['newpassword2']);
			if($password1 == $password2) {
			   $insertpassword = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
			   $insertpassword->execute(array($password1, $_SESSION['id']));
			   header('Location: profil.php?id='.$_SESSION['id']);
			} 
			
			else {
			   $msg = "Vos deux mdp ne correspondent pas !";
			}
	}



}//try
}
catch(PDOException $e){
    
    echo 'echec : ' .$e->getMessage();
}

  
?>
	<html>
	   <head>
	      <title>Modification profil</title>
	      <meta charset="utf-8">
		  <link rel="stylesheet" href="module.css">
	   </head>
	   <body>
	      <div align="center">
	         <h2>Modifier votre profil</h2>
	         <br /><br />
	         <form method="POST" action="">
	            <input type="text" name="newlogin" placeholder="login" value="<?php echo @$user['login'] ?>" /><br /><br />
                <input type="text" name="newprenom" placeholder="prenom" value="<?php echo @$user['prenom'];  ?>" /><br /><br />
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