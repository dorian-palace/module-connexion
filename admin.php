<?php
session_start();


$servname = 'localhost';
$dbname = 'moduleconnexion';  // log de connexion à la bdd 
$user = 'root';
$mdp ='root';


    $bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
     $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;

$utilisateurs = $bdd->query("SELECT * FROM utilisateurs ORDER BY id DESC");//requete 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="module.css">
    <title>Administration</title>
</head>
<body>
<header>
    <div class="aadmin"> 
    <a href="index.php" >Accueil</a>
    <a href="connexion.php">Connexion</a>
    <a href="inscription.php">Inscription</a>
    </div>
</header>

<h1 id="admin">Administrateur</h1>
    <ul>
        
<?php while($membres = $utilisateurs->fetch()) {?>

    <li id="admin2"> <?= $membres['id'] ?> : <?= $membres['login']?> : <?= $membres['nom']?> : <?= $membres['prenom']?> </li>
                    
<?php } ?>
                
        
    </ul>
</body>
<a href="index.php">Accueil</a>
<a href="deconnexion.php">Déconnexion</a>
</html>