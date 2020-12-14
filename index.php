<?php

include("config/config.php");
include("config/bd.php"); // commentaire
include("divers/balises.php");
include("config/actions.php");
session_start();



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Corner - Le meilleur des réseaux social</title>

    <link rel="stylesheet" href="icontypo/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400i,500,500i,600,600i,700,800,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="images/logo/icon_logo.png" type="image/x-icon">
    <link rel="icon" href="images/logo/icon_logo.png" type="image/x-icon">




</head>

<body>

<?php

if (isset($_SESSION['info'])) {
    echo "<div class='alert alert-info alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button>
        <strong>Information : </strong> " . $_SESSION['info'] . "</div>";
    unset($_SESSION['info']);
}
?>


<div class="headercote">
  <?php if (isset($_SESSION['id'])) {
    echo "<a href='index.php?action=connected' id='logoheader'><img src='images/logo/logo.png' alt='logo' id='imglogoheader'></a>";
  } else {
    echo "<a id='logoheader'><img src='images/logo/logo.png' alt='logo' id='imglogoheader'></a>";
  }?>

<?php
  if(isset($_SESSION['avatar'])){
    echo "<a href='index.php?action=compte&id=".$_SESSION['id']."' class='photodeprofil'><div style='background-image: url(".$_SESSION['avatar'].");'></div></a>";
  }
?>
  <div class="connexion">

<?php
          if (isset($_SESSION['id'])) {
              echo "<a class='ico-deconnexion' href='index.php?action=deconnexion'><i class='fi-xnluxx-sign-out'></i>
        </a></li>";

          } else {
              echo "<a href='index.php?action=login' class='ico-connexion'><i class='fi-xnluxx-sign-in'></i></a>";
              echo "<a href='index.php?action=register' class='ico-register'><i class='fi-xnluxx-user-plus'></i></a>";

          }
          ?>



  </div>






</div>
<?php

if (isset($_SESSION['id'])) {

  if (isset($_POST['nomamis'])) {
    echo "<div class='choix-menu'>
            <div class='menu_interractions active'>
              <i class='fi-xnsuhl-search'></i>
            </div>
            <div class='menu_publication'>
              <img src='images/logo/icon_logo.png' alt='publier'>
              <span>Publication</span>
            </div>
            <div class='menu_amis'>
              <i class='fi-xnsuxl-friend'></i>
            </div>
          </div>";
  }
  elseif (isset($_GET['action']) && $_GET['action'] == 'modifier_view') {
    // code...
  }
  else {
    echo "<div class='choix-menu'>
            <div class='menu_interractions'>
              <i class='fi-xnsuhl-search'></i>
            </div>
            <div class='menu_publication active'>
              <img src='images/logo/icon_logo.png' alt='publier'>
              <span>Publication</span>
            </div>
            <div class='menu_amis'>
              <i class='fi-xnsuxl-friend'></i>
            </div>
          </div>";
  }


}

?>


  <?php
  // Quelle est l'action à faire ?
  if (isset($_GET["action"])) {
      $action = $_GET["action"];
  } else {
    if(isset($_SESSION['id']))
    $action='connected';
    else
      $action = "accueil";
  }

  if (!isset($_SESSION['id']) && isset($_GET["action"]) && $_GET["action"] == "connected" ) {

        $action = "accueil";
      
  }

  // Est ce que cette action existe dans la liste des actions
  if (array_key_exists($action, $listeDesActions) == false) {
      include("vues/404.php"); // NON : page 404
  } else {
      include($listeDesActions[$action]); // Oui, on la charge
  }

  ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
  ?>


<script>document.cookie = "largeur=" + window.innerWidth + "; expires=0"</script>
<script defer src="https://friconix.com/cdn/friconix.js"></script>
<script charset="utf-8"></script>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/script.js">

</script>

</script>


</script>
</body>
</html>
