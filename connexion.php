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
        echo 'Vous êtes connecté ! <br/>';
      }
      $req->closeCursor();//permet a la requete d'etre de nouveau executée
  }
  else
  {
    echo 'Renseignez un identifiant !<br.>';
  }
  
}
?>



<form action="connexion.php" method="post">
  <div class="container">
    <label for="login"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" id="login"name="login" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="password" name="password" required>

    <button type="submit" name="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
</form>



<?php



?>