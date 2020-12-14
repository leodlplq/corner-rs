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
  <div class="supprimer_amis">
    <span>Souhaitez vous vraiment supprimer de vos amis <?php echo $_GET['nom']?></span>
    <div>
    <a href="index.php?action=compte&id=<?php echo $_GET['id']?>" class="bouton_supprimer_amis white">NON</a>
    <a href="index.php?action=delete&id=<?php echo $_GET['id']?>" class="bouton_supprimer_amis white">OUI</a>
  </div>
  </div>

</body>
</html>
