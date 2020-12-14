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
  <form action="index.php?action=modifier&id=<?php echo $_GET['id'];?>" method="POST" enctype="multipart/form-data">

    <div>
      <label for="mail">Pseudo</label>
      <input type="text" name="prenom" placeholder="Harry Potter" value="<?php echo $_GET['nom']?>">
    </div>

    <div><label id="btnPP" for="PP">Photo de profil</label>
    <input id="PP" type="file" name="avatar"></div>

      <div>
    <input type="submit" value="Modifier">
</div>
  </form>

  <a href="index.php" class="leave-form"><i class="fi-xnluxx-times-wide"></i></a>

</div>
</body>
</html>
