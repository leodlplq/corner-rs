<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div class="nav-connected">
<?php
    if (isset($_COOKIE['largeur'])&& $_COOKIE['largeur'] <1000) {
  // code...

       if (isset($_POST['nomamis']) && $_POST['nomamis'] != "") {
        echo "<div class='publication' style='display:none;'>";
      }
      else {
          echo "<div class='publication'style='display:flex;'>";
      }
    }
    else {
      echo "<div class='publication'>";
    }?>
  <?php // On veut affchier notre mur ou celui d'un de nos amis et pas faire n'importe quoi
    $idAmiLien = $_GET['id'];
    $ok = false;

    if(!isset($_GET["id"]) || $_GET["id"]==$_SESSION["id"]){
        $id = $_SESSION["id"];
        $ok = true; // On a le droit d afficher notre mur
    } else {
        $id = $_GET["id"];
        // Verifions si on est amis avec cette personne
        $sql = "SELECT * FROM lien WHERE etat='ami'
              AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";
        $q3 = $pdo->prepare($sql);
        $q3->execute(array($id, $_SESSION["id"], $_SESSION['id'],$id));

        if ($line3=$q3->fetch()) {
          if (isset($line3['etat'])){
            $ok = true;
          }
          else {
            $ok = false;
          }
        }

        // A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que lon est pas ami avec cette personne
    }
    if($ok==false) {
      $sql = "SELECT * FROM user WHERE id=?";
      $q = $pdo->prepare($sql);
      $q->execute(array($id));
      // A completer
      if($line=$q->fetch()) {
            $lien_photoprofil = $line['avatar'];
            $nom_affichage = $line['login'];

            echo "
            <div class='informationsbases'>
                    <div class='infosgénérale'>
                      <div class='photodeprofil_compte' style='background-image: url(".$lien_photoprofil.");'>
                      </div>
                      <div class='nom_compte'>
                      <span class='nom_compte_span'>".$nom_affichage."</span>
                      </div>
                    </div>
                  </div>
                ";
        echo "<div class='pasamiinformations'><span>Vous n'êtes pas encore amis avec <b>$nom_affichage</b>, demandez lui de le devenir ou attendez qu'il réponde !</span></div>";
    }} else {

      // A completer
      $sql = "SELECT * FROM user WHERE id=?";
      $q = $pdo->prepare($sql);
      $q->execute(array($id));
      // A completer
      if($line=$q->fetch()) {
            $lien_photoprofil = $line['avatar'];
            $nom_affichage = $line['login'];
            $id_personne = $line['id'];

            echo "
                    <div class='informationsbases'>
                      <div class='infosgénérale'>
                        <div class='photodeprofil_compte' style='background-image: url(".$lien_photoprofil.");'>
                        </div>
                        <div class='nom_compte'>
                        <span class='nom_compte_span'>".$nom_affichage."</span>
                        </div>";

                        if ($id_personne == $_SESSION['id']) {
                          echo "<a href='index.php?action=modifier_view&id=$id_personne&nom=$nom_affichage' class='bouton_supprimer_amis'>Modifier vos informations</a>";
                        }
                        else {
                          echo "<a href='index.php?action=deleteview&id=$id_personne&nom=$nom_affichage' class='bouton_supprimer_amis'>Supprimer</a>";
                        }
                    echo "  </div>
                    </div>
                ";


};
?>
<div class="publication_envoi_block phone">
  <form action="index.php?action=publication&id=<?php echo $_GET['id']; ?>&lieu=compte" method="post" class="publication_envoi_form" enctype="multipart/form-data">
    <div class="text_publication_block">
      <textarea id="publication" name="publication" rows="8" cols="80" placeholder="Exprimez-vous..."></textarea>
      <div class="envoie_publi_block">
        <label for="fdp"><i class="icon-icon-montagne ajout_photo_publi"></i></label>
        <input type="file" id="fdp" name="photo_publication" class="file">
        <input type="submit" value="Publier" class="publication_button">
      </div>
    </div>
  </form>
</div>

<?php
        // A completer
        $sql = "SELECT * FROM ecrit WHERE idAmi=? order by dateEcrit DESC";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        // A completer
        while($line=$q->fetch()) {


                

          if ($line['image'] == "none") {
            $image= "none";
          }
          else {
            $image = $line['image'];
          }

          $idPubli = $line['idPubli'];
          $contenupubli = $line['contenu'];
          $datePublication = $line['dateEcrit'];
          $idAuteur = $line['idAuteur'];
          $idAmi = $line["idAmi"];

          $sql = "SELECT * FROM user WHERE id=? ";
          $q2 = $pdo->prepare($sql);
          $q2->execute(array($idAuteur));

          while($line2=$q2->fetch()) {

            $nomAuteur = $line2['login'];
            $avatarAuteur = $line2['avatar'];

            echo "
            <div class='publi'>
              <div class='header_publi'>

                  <div class='gauche'>
                    <a href='index.php?action=compte&id=".$idAuteur."' class='photo_profil_publi'><div style='background-image: url(".$avatarAuteur.");'></div></a>
                    <div>
                    <a href='index.php?action=compte&id=".$idAuteur."'><span class='nom_publi'>$nomAuteur</span></a>
                    <span class='datePubli'>$datePublication</span>
                    </div>
                  </div>



                  <div class='droite'>";

                  $sql_aime = "SELECT * FROM aime WHERE idEcrit = ? && idUtilisateur = ?";
                  $query_aime = $pdo->prepare($sql_aime);
                  $query_aime->execute(array($idPubli, $_SESSION['id']));

                  if ($line_aime=$query_aime->fetch()) {

                    $sql_nb = "SELECT count(*) FROM aime WHERE idEcrit = ?";
                    $query_nb = $pdo->prepare($sql_nb);
                    $query_nb->execute(array($idPubli));

                    if ($line_nb=$query_nb->fetch()) {
                      $chiffre = $line_nb['0'];
                      echo "<span>$chiffre</span>";
                    }


                    $idLike =$line_aime['id'];
                    echo "<a href='index.php?action=unlike&idPubli=$idPubli&idLike=$idLike&lieu=compte&idAmi=$idAmi' class='icon_inter_publi like'><i class='icon-icon-coeur like'></i></a>";
                  }
                  else {
                    $sql_nb = "SELECT count(*) FROM aime WHERE idEcrit = ?";
                    $query_nb = $pdo->prepare($sql_nb);
                    $query_nb->execute(array($idPubli));

                    if ($line_nb=$query_nb->fetch()) {
                      $chiffre = $line_nb['0'];
                      echo "<span>$chiffre</span>";
                    }
                    echo "<a href='index.php?action=like&idPubli=$idPubli&lieu=compte&idAmi=$idAmi' class='icon_inter_publi unlike'><i class='icon-icon-coeur unlike'></i></a>";

                  }

                  if ($idAmi == $_SESSION['id'] || $idAuteur == $_SESSION['id']) {
                    echo "<a href='index.php?action=supprimer&idPubli=$idPubli&id=$idAmi&lieu=compte' class='icon_inter_publi suppression_publi'><i  class='fi-xnsuxl-trash-bin'></i></a>";
                  };
                    echo "
                  </div>
              </div>

              <div class='contenu_publi'>
                <p>".$contenupubli."</p>
                ";
                if ($image == "none") {

                }
                else{
                    echo "<img class='image_publi' src=' ".$image."' alt='images_publication'>";
                }


                echo"
              </div>

              <div class='commentaire_publi'>

              </div>

            </div>
                  ";

   }}};
    ?>
</div>












<?php

if (isset($_COOKIE['largeur'])&& $_COOKIE['largeur'] <1000) {
// code...

   if (isset($_POST['nomamis']) && $_POST['nomamis'] != "") {
    echo "<div class='interactions_block' style='display:flex;'>";
  }
  else {
        echo "<div class='interactions_block'style='display:none;'>";
  }
}
else {
  echo "<div class='interactions_block'>";
}?>
  <div class="interactions_items">

    <div class="recherche_amis_block">
      <div class="recherche_amis_items">
        <form class="form_recherche_amis" action="#" method="post">
          <label for="nomamis"><i class="fi-xnsuxl-friend nouveauxAmis"></i></label>
          <div class="recherche_amis_zone">
            <input type="text" name="nomamis" id="nomamis" placeholder="Rechercher et ajouter des amis...">
            <label for="recherche_amis_submit"><i class="fi-xnsuhl-search loupeRecherche"></i></label>
            <input type="submit" value="" id="recherche_amis_submit">
          </div>
        </form>
      </div>
    </div>
<?php
    if(isset($_POST['nomamis']) && $_POST['nomamis'] != "") {

        $recherche = $_POST['nomamis'];
        $sqle = "  SELECT * FROM user WHERE login LIKE ?";

        $query = $pdo->prepare($sqle);
        $query->execute(array('%'.$recherche.'%'));

        echo "<div class='div_affichage_amis'>";

        while($line = $query->fetch()) {
          $idRecherche = $line['id'];
          $nom = $line['login'];
          $avatar = $line['avatar'];

          $sql_amis = "SELECT * FROM lien WHERE (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?)";
          $query_amis = $pdo->prepare($sql_amis);
          $query_amis -> execute(array($idRecherche, $_SESSION["id"], $_SESSION['id'],$idRecherche));

          if ($line_amis = $query_amis->fetch()) {
            $etat = $line_amis['etat'];
            if (($etat == 'ami' || $etat == 'attente' || $idRecherche == $_SESSION['id']) ) {

              echo "<div class='friends_blocks'>
              <div>
                  <a href='index.php?action=compte&id=".$idRecherche."' class='friends_blocks_img'><div style='background-image: url($avatar);'></div></a>
                  <a href='index.php?action=compte&id=".$idRecherche."' class='friend_names'>$nom</a>
                  </div>
              </div>
              ";
            }

          }

          else {
            if($idRecherche != $_SESSION['id']){
              echo "
              <div class='friends_blocks'>
                <div>
                  <a href='index.php?action=compte&id=".$idRecherche."' class='friends_blocks_img'><div style='background-image: url($avatar);'></div></a>
                  <a href='index.php?action=compte&id=".$idRecherche."' class='friend_names'>$nom</a>
                </div>
                <div>
                  <a href='index.php?action=ajouter&idAmi=$idRecherche'><i class='fi-xnsuxl-user-plus-solid'></i></a>
                </div>
                </div>";
          }}
      }
        echo "</div>";


    }



   ?>

   <div class="publication_envoi_block">
     <form action="index.php?action=publication&id=<?php echo $_GET['id']; ?>&lieu=compte" method="post" class="publication_envoi_form" enctype="multipart/form-data">
       <div class="text_publication_block">
         <textarea id="publication" name="publication" rows="8" cols="80" placeholder="Exprimez-vous..."></textarea>
         <div class="envoie_publi_block">
           <label for="photo_publication"><i class="icon-icon-montagne ajout_photo_publi"></i></label>
           <input type="file" id="photo_publication" name="photo_publication">
           <input type="submit" value="Publier" class="publication_button">
         </div>
       </div>
     </form>
   </div>


    <div class="amis_en_attentes_block">
      <div class="amis_en_attentes_items">

        <div class="amis_en_attentes_title">Ils vous ont demandé en ami.</div>
          <div class="ami_en_attente_items">



        <?php
          $sql_demande = "SELECT * FROM lien WHERE etat='attente' && idUtilisateur2=?";
          $query_demande = $pdo->prepare($sql_demande);
          $query_demande->execute(array($_SESSION['id']));

          while ($line_demande=$query_demande->fetch()) {
            $idAttente = $line_demande['id'];
            $id = $line_demande['idUtilisateur1'];
            $sql_demande_ami = "SELECT * FROM user WHERE id =?";
            $query_demande_ami = $pdo->prepare($sql_demande_ami);
            $query_demande_ami->execute(array($id));

            if ($line_demande_ami=$query_demande_ami->fetch()) {
              $nom_demandeur = $line_demande_ami['login'];

              echo "<div class='ami_en_attente_item'>
                <div class='ami_en_attente_nom'>$nom_demandeur</div>
                <div class='decision_ami'>
                  <a href='index.php?action=accepter&idAttente=$idAttente'><i class='fi-xwsuxl-check oui_ami'></i></a>
                  <a href='index.php?action=refuser&idAttente=$idAttente''><i class='fi-xnsuxl-times-solid non_ami'></i></a>
                </div>
              </div>";
            }


          }


        ?>
      </div>
      </div>
    </div>



</div>
</div><div class="friends">
  <div class="friends_items">
    <span class="titre_friends">Vos Amis</span>
  <?php


  $sql = "SELECT * FROM lien WHERE etat='ami' && (idUtilisateur1=? OR idUtilisateur2=?)";
  $sql1 = $pdo->prepare($sql);
  $sql1->execute(array($_SESSION["id"], $_SESSION['id']));

  while($line1=$sql1->fetch()) {

if ($line1['idUtilisateur1'] == $_SESSION['id']) {
$idAmi = $line1['idUtilisateur2'];
}
else {
$idAmi = $line1['idUtilisateur1'];
}



    $sql = "SELECT * FROM user WHERE id= ?";
    $sql2 = $pdo->prepare($sql);
    $sql2->execute(array($idAmi));

    while($line2=$sql2->fetch()) {

      if ($idAmi == $_SESSION['id']) {

      }
      else {
        // code...

      $nomAmi = $line2['login'];
      $imgAmi = $line2['avatar'];
      $idAmi = $line2['id'];

      echo "
        <div class='friends_blocks'>
        <div>
          <a href='index.php?action=compte&id=".$idAmi."' class='friends_blocks_img'><div style='background-image: url(".$imgAmi.");'></div></a>
          <a href='index.php?action=compte&id=".$idAmi."' class='friend_names'>$nomAmi</a>
          </div>
        </div>";}

    }

}
?>
</div>


<div class="attente-item">
<span class="titre_friends">Vos demandes en attentes</span>
<?php


$sql = "SELECT * FROM lien WHERE etat='attente' && idUtilisateur1=?";
$sql1 = $pdo->prepare($sql);
$sql1->execute(array($_SESSION["id"]));

while($line1=$sql1->fetch()) {
$idAmi = $line1['idUtilisateur2'];

$sql = "SELECT * FROM user WHERE id= ?";
$sql2 = $pdo->prepare($sql);
$sql2->execute(array($idAmi));

while($line2=$sql2->fetch()) {
if ($idAmi == $_SESSION['id']) {

}
else {
  // code...

$nomAmi = $line2['login'];
$imgAmi = $line2['avatar'];
$idAmi = $line2['id'];

echo "<div class='friends_blocks'>
<div>
    <a href='index.php?action=compte&id=".$idAmi."' class='friends_blocks_img'><div style='background-image: url($imgAmi)'></div></a>
    <a href='index.php?action=compte&id=".$idAmi."' class='friend_names'>$nomAmi</a>
  </div>
  </div>";}

}

}
?>

</div>


</div>

<script type="text/javascript" src="assets/slick/slick.min.js"></script>
</body>
</html>
