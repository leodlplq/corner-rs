<div class="nav-connected">



    <?php

    //+ Maigret Aurélien
//@ https://www.dewep.net
function getRelativeTime($date)
{
    $date_a_comparer = new DateTime($date);
    $date_actuelle = new DateTime("now");

    $intervalle = $date_a_comparer->diff($date_actuelle);

    if ($date_a_comparer > $date_actuelle)
    {
        $prefixe = 'dans ';
    }
    else
    {
        $prefixe = 'il y a ';
    }

    $ans = $intervalle->format('%y');
    $mois = $intervalle->format('%m');
    $jours = $intervalle->format('%d');
    $heures = $intervalle->format('%h');
    $minutes = $intervalle->format('%i');
    $secondes = $intervalle->format('%s');

    if ($ans != 0)
    {
        $relative_date = $prefixe . $ans . ' an' . (($ans > 1) ? 's' : '');
        if ($mois >= 6) $relative_date .= ' et demi';
    }
    elseif ($mois != 0)
    {
        $relative_date = $prefixe . $mois . ' mois';
        if ($jours >= 15) $relative_date .= ' et demi';
    }
    elseif ($jours != 0)
    {
        $relative_date = $prefixe . $jours . ' jour' . (($jours > 1) ? 's' : '');
    }
    elseif ($heures != 0)
    {
        $relative_date = $prefixe . $heures . ' heure' . (($heures > 1) ? 's' : '');
    }
    elseif ($minutes != 0)
    {
        $relative_date = $prefixe . $minutes . ' minute' . (($minutes > 1) ? 's' : '');
    }
    else
    {
        $relative_date = $prefixe . ' quelques secondes';
    }

    return $relative_date;
}

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



      <div class="publication_envoi_block phone">
        <form action="index.php?action=publication" method="post" class="publication_envoi_form" enctype="multipart/form-data">
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

      <?php


      //test publication
      $sql = "SELECT * FROM ecrit
              JOIN user on idAuteur = user.id
              WHERE (idAuteur=?)
                   OR idAuteur IN (SELECT idUtilisateur1 FROM lien where etat='ami' AND idUtilisateur2=?)
                   OR idAuteur IN (SELECT idUtilisateur2 FROM lien where etat='ami' AND idUtilisateur1=?)
              ORDER BY ecrit.idPubli DESC
              ";
      $query = $pdo-> prepare($sql);
      $query-> execute(array($_SESSION["id"], $_SESSION['id'],$_SESSION["id"]));



      while($line=$query->fetch()) {

        $sql_1 = "SELECT * FROM lien WHERE etat = 'ami' AND ((idUtilisateur1 = ? AND idUtilisateur2 = ?) OR (idUtilisateur1 = ? AND idUtilisateur2 = ?))";
        $query_1 = $pdo-> prepare($sql_1);
        $query_1-> execute(array($line['idAmi'],$_SESSION['id'],$_SESSION['id'],$line['idAmi']));

        if(!$line_1=$query_1->fetch() AND $line['idAmi'] != $_SESSION['id']) {
          continue;
        }




        if ($line['image'] == "none") {
          $image= "none";
        }
        else {
          $image = $line['image'];
        }

        $idPubli = $line['idPubli'];
        $contenupubli = $line['contenu'];
        $datePublication = getRelativeTime($line['dateEcrit']);
        $idAuteur = $line['idAuteur'];

        $nomAuteur = $line['login'];
        $avatarAuteur = $line['avatar'];


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
                          echo "<a href='index.php?action=unlike&idPubli=$idPubli&idLike=$idLike' class='icon_inter_publi like'><i class='icon-icon-coeur like'></i></a>";
                        }
                        else {
                          $sql_nb = "SELECT count(*) FROM aime WHERE idEcrit = ?";
                          $query_nb = $pdo->prepare($sql_nb);
                          $query_nb->execute(array($idPubli));

                          if ($line_nb=$query_nb->fetch()) {
                            $chiffre = $line_nb['0'];
                            echo "<span>$chiffre</span>";
                          }
                          echo "<a href='index.php?action=like&idPubli=$idPubli' class='icon_inter_publi unlike'><i class='icon-icon-coeur unlike'></i></a>";
                        }


                        if ($idAuteur == $_SESSION['id']) {
                          echo "<a href='index.php?action=supprimer&idPubli=$idPubli' class='icon_inter_publi suppression_publi'><i  class='fi-xnsuxl-trash-bin'></i></a>";
                        }
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

 };








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
              <form class="form_recherche_amis" action="index.php?action=connected" method="post">
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
            <form action="index.php?action=publication" method="post" class="publication_envoi_form" enctype="multipart/form-data">
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
      </div>
      <div class="friends">
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
                <a href='index.php?action=compte&id=".$idAmi."' class='friends_blocks_img'><div style='background-image: url($imgAmi);'></div></a>
                <a href='index.php?action=compte&id=".$idAmi."' class='friend_names'>$nomAmi</a>
            </div>
            </div>";


              }

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
          <a href='index.php?action=compte&id=".$idAmi."' class='friends_blocks_img'><div style='background-image: url(".$imgAmi.");'></div></a>
          <a href='index.php?action=compte&id=".$idAmi."' class='friend_names'>$nomAmi</a>
      </div>
        </div>";}

    }

}
?>

</div>


  </div>

</body>
</html>
