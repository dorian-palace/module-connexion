<?php 
//id sql

session_start();
$serveur = "localhost";
$dbname = "moduleconnexion";
$user = "root";
$pass = "root";

try{ 
    //Connexion BDD 
    $log = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
    $log->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
// Erreur
catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}

//Vérification 
if (isset($_POST['login']) && isset($_POST['password'])){


  if(!empty($_POST['login']) && !empty($_POST['password']))
  {
    $login = $_POST['login'];
    $req = $log->prepare('SELECT id, password FROM utilisateurs WHERE login= :login');//Prépare une requête à l'exécution et retourne un objet
    $req-> execute(array(
      //Exécute une requête préparée
      'login' => $login));

      $result = $req->fetch();//fetch récupère les valeurs de la requete

      if(!$result OR !password_verify($_POST['password'], $result['password'])){
        //Vérifie qu'un mot de passe correspond à un hachage
        
        echo 'Identifiant ou mot de passe incorrect.<br/>';
      }
      else{
        $_SESSION['login'] = $user['login'];
        $_SESSION['password'] = $user['password'];
        echo 'Vous êtes connecté ! <br/>';
        header('location: profil.php');
      }
      $req->closeCursor();//permet a la requete d'etre de nouveau executée
  }
  else
  {
    echo 'Renseignez un identifiant !<br.>';
  }

}
?>
<html>
   <head>
      <title>Connexion</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Connexion</h2>
         <br /><br />
         <form method="POST" action="">
            <input type="text" name="login" placeholder="login" />
            <input type="password" name="password" placeholder="password" />
            <br /><br />
            <input type="submit" name="submit" value="Se connecter !" />
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>