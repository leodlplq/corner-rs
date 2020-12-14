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

<div class="formregister">
  <form action="index.php?action=creation" method="POST" enctype="multipart/form-data">

    <div>
      <label for="mail">Prénom et Nom</label>
      <input type="text" name="prenom" placeholder="Harry Potter" required>
    </div>

    <div>
      <label for="mail">Mail</label>
      <input type="mail" name="mail" placeholder="harrypotter@gmail.com" required>
      <?php
      if (isset($_GET['erreur'])) {
        echo "<span class='erreur_crea'>Veuillez entrée une adresse mail valable</span>";
      }

      ?>
    </div>
    <div>
      <label for="pwd">Mot de passe</label>
      <input type="password" name="pwd" placeholder="Mot de passe" required>
    </div>

    <div>
      <label id="btnPP" for="PP">Photo de profil</label>
      <input id="PP" type="file" name="avatar">
    </div>

    <div>
      <input type="submit" value="S'inscrire">
    </div>
  </form>

  <a href="index.php" class="leave-form"><i class="fi-xnluxx-times-wide"></i></a>

</div>
</body>
</html>
