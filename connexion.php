<?php 
session_start();
if (isset($_POST['submit']))
{
  $login = $_POST['login'];
  $pass = $_POST ['password'];

  $db = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'root');

  $sql = "SELECT * FROM utilisateurs where login = '$login' ";
  $result = $db->prepare($sql);
  $result->execute();

  if($result->rowCount() > 0)
  {
      $date = $result-> fetchAll();
      if (password_verify($pass, $data[0]['password'])){
        $_SESSION['login'] =$login;
        echo "Connexion";
      }
  }
  else{
    echo "non";
  }
}
var_dump($sql);
var_dump($_SESSION);

?>



<form action="connexion.php" method="post">
  <div class="container">
    <label for="login"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="login" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" name="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
</form>



<?php



?>