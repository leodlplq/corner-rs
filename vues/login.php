<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div class="nav">
  </div>

<div class="formlogin">

<form action="index.php?action=connexion" method="post" >
  <div>
    <label for="login">Mail</label>
    <input type="text" name="mail" placeholder="exemple@gmail.com" required>

  </div>
  <div>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" placeholder="Mot de passe" required>
  </div>
  <?php
    if (isset($_GET['erreur'])) {
      echo "<span class='erreur_login'>Mail ou mot de passse incorrect.</span>";
    }


   ?>
   <div>
  <input type="submit" value="Connexion">
</div>
</form>
  <a href="index.php" class="leave-form"><i class="fi-xnluxx-times-wide"></i></a>
</div>

</body>
</html>
