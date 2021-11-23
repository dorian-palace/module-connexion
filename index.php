<?php
session_start();
if (isset($_SESSION['login']))
{
    echo "Vous êtes connecté";
}
else
{
    echo "Vous êtes déconnecter";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="module.css">
    <title>Accueil</title>
</head>
<body>
    
</body>
</html>
<h1> Module de connexion </h1>

<h3></h3>
<div class="indexcoin">
<form method="POST" action="connexion.php">
<input type="submit" name="connexion" value="connexion" >
</form>

<form method="POST" action="inscription.php">
<input type="submit" name="inscription" value="inscription" >
</form>
</div>

<div class="ulindex">
<ul >
    <h3><a href="profil.php">Profil</a></h3>
    <h3><a href="admin.php">Admin</a></h3>
    <a href="deconnexion.php">Déconnexion</a>
    <a href="https://github.com/dorian-palace/module-connexion"></a>
</ul>
</div>

<?php


?>