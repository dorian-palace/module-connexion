<?php
session_start();


$servname = 'localhost';
$dbname = 'dorian-palace_moduleconnexion';  // log de connexion à la bdd 
$user = 'moduleconnexion';
$mdp ='moduleconnexion';


 try{
    $bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
     $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    
    // message en cas d'erreur 
 
        
        if(isset($_POST['submit'])){//Si ce qui est envoyer a une valeur 

            $login = htmlspecialchars($_POST['login']);
            $password = sha1($_POST['password']);
            
            
           
            if(!empty($login) && !empty($password)){//Si login et password n'est pas vide

                $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login= :login AND password= :password");//préparation de la requete 
                $requser->bindValue(':login', $login);//Associe une valeur à un paramètre 
                $requser->bindValue(':password', $password);//Associe une valeur à un paramètre 
                $requser->execute(); //execution de la requete
                $userexist = $requser->rowCount();//Retourne le nombre de lignes affectées par le dernier appel à la fonction 

                if($userexist == 1 ){
                    
                    $userinfo = $requser->fetch();//recupere le resultat
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['login'] = $userinfo['login'];
                    $_SESSION['nom'] = $userinfo['nom'];
                    $_SESSION['prenom'] = $userinfo['prenom'];
                    $_SESSION['password'] = $userinfo['password'];
                    
                
                if($userinfo['login']){

                    header('location: index.php');
                }

            }else{

                echo '<p class="erreur">'.'Mauvais identifint ou mot de passe'. '</p>';
            }
            }
            
        }
     
}   catch(PDOException $e){
    
    echo 'echec : ' .$e->getMessage();
}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="module.css">
    <title>connexion</title>
</head>
<body>
<div class="aco">
<a href="index.php">Accueil</a>
<a href="connexion.php">Connexion</a>
<a href="inscription.php">Inscription</a>
</div>

    <main class="main2 ">

        <div class="contco">
    <form class="formulaire2" action="#" method="post">

    <h1>Connexion</h1>
    <br />
         <br />
        <input type="text" name="login" value="login" require>
        <br>
        <input type="password" name='password' value="password" require>
        <br />
   

        <input type="submit"   name ='submit'value="submit">
        <button ><a href="deconnexion">Se deconnecter</a></button>

    </form>
            </div>
            

</main>



</body>
</html>
