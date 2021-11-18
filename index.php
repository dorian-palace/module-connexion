<?php
session_start();
if (isset($_SESSION['login']))
{
    echo "Vous êtes connecté";
}
else
{
    
}

?>


<h1> Module de connexion </h1>

<h3></h3>

<form method="POST" action="connexion.php">
<input type="submit" name="connexion" value="connexion" >
</form>

<form method="POST" action="inscription.php">
<input type="submit" name="inscription" value="inscription" >
</form>


<ul>
    <h3><a href="profil.php">Profil</a></h3>
    <h3><a href="admin.php">Admin</a></h3>
</ul>

<?php


?>