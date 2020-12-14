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

  <div class="pas_ami">
    Vous n'etes pas amis avec lui, vous ne pouvez pas publiez.
    <a href="index.php?action=compte&id=<?php echo $_GET['idAmi']?>">X</a>
  </div>

</body>
</html>
