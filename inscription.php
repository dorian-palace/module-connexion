<?php
  $serveur = "localhost";
  $dbname = "moduleconnexion";
  $user = "root";
  $pass = "root";
  
 
  try{
      //On se connecte à la BDD
      $log = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
      $log->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      //On insère les données reçues

      $requete = $log->prepare(
          "INSERT INTO utilisateurs(login,prenom,nom,password)
          VALUES (:login,:prenom,:nom,:password)"
      );

      $requete->bindParam(':login' ,$login);
      $requete->bindParam(':prenom' ,$prenom);
      $requete->bindParam(':nom' ,$nom);
      $requete->bindParam(':password' ,$password);

      $login = $_POST['login'];
      $prenom = $_POST['prenom'];
      $nom = $_POST['nom'];
      $password = $_POST['password'];
      

      $requete->execute();

//Ne pas utiliser hashed_password utilise password_hash voir la doc php.net
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      var_dump($hashed_password);
    
  }

  catch(PDOException $e){
      echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

  
 

if (isset($_POST['envoi'])){
    if(!empty($_POST['login']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['pass']) AND !empty($_POST['confirm'])){
        $login = htmlspecialchars($_POST['login']);//encodage 
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $password = htmlspecialchars($_POST['password']);
        
    }
    else{
        echo "Remplissez ce champ";
    }
} 
?>


<form name="inscription" method="POST" action="" align="center">
<fieldset>
    <legend><h2>Inscription</h2></legend>
    Login<br>
    <input type="text" name="login" value="" autocomplete="off" required><br>
    Prenom<br>
    <input type="text" name="prenom" value="" autocomplete="off" required><br>
    Nom<br>
    <input type="text" name="nom" value="" autocomplete="off" required><br>
    Mot de passe<br>
    <input type="password" name="password" value="" autocomplete="off" required><br>
    Confirmation de mot de passe<br>
    <input type="password" name="confirm" value="" autocomplete="off" required><br>
    <br/><br/>
    <input type="submit" name="envoi">

</fieldset>
</form>
