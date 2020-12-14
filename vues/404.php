<div class="nav404">
  <img id="logo_404" src="images/logo/erreur404.svg" alt="logo noir">
  <span id="slogan_404">t'as cassé internet !!! <?php

if (isset($_SESSION['id'])) {
  $sql = "SELECT * FROM user WHERE id=?";
  $query = $pdo-> prepare($sql);
  $query -> execute(array($_SESSION["id"]));


  $line = $query-> fetch();
    echo $line["login"];


}


?></span>
</div>
