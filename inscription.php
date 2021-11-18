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

      
      var_dump($hashed_password);

      $requete->bindParam(':login' ,$login);
      $requete->bindParam(':prenom' ,$prenom);
      $requete->bindParam(':nom' ,$nom);
      $requete->bindParam(':password' ,$hashed_password);
/*binParam = Identifiant. Pour une requête préparée utilisant des marqueurs nommés, ce sera le nom du paramètre sous la forme :name. Pour une requête préparée utilisant les marqueurs interrogatifs, ce sera la position indexé +1 du paramètre.*/


      $login = $_POST['login'];
      $prenom = $_POST['prenom'];
      $nom = $_POST['nom'];
      $password = $_POST['password'];
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      
      if($_POST['password'] !=$_POST['confirm']){
        die("Mot de passe incorrect");//Si les mdp ne sont pas idendique (die)"mot de pass incorrect et ne crée pas d'utilisateurs dans la bdd
    }else{
        //Sinon execute la requete et crée l'utilisateurs dans la bdd
    
    
     $requete->execute();
 }
//Ne pas utiliser hashed_password utilise password_hash voir la doc php.net
    
 }

 
// Erreur
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
