<?php

$titre = "titre publication";
$id = $_SESSION['id'];
$message = $_POST['publication'];
$date = date("Y-m-d H:i:s");
if(!isset($_GET['id'])) {
  $idAmi = $id;
}
else {
  $idAmi = $_GET['id'];
}


if ($message != NULL  && (ctype_space($message) != true) || (isset($_FILES["photo_publication"]) && $_FILES["photo_publication"]["error"] == UPLOAD_ERR_OK)) {






$image = 'images/photo_publication/'.$_FILES['photo_publication']['name'];
$uploads_dir = 'images/photo_publication/';



$sql = "SELECT * FROM lien WHERE etat='ami'
      AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";
$q3 = $pdo->prepare($sql);
$q3->execute(array($id, $idAmi, $idAmi,$id));

if ($line3=$q3->fetch() || $idAmi == $id) {


    if (isset($_FILES["photo_publication"]) && $_FILES["photo_publication"]["error"] == UPLOAD_ERR_OK) {



      var_dump($_FILES["photo_publication"]["error"]);
        $tmp_name = $_FILES["photo_publication"]["tmp_name"];
        // basename() peut empêcher les attaques de système de fichiers;
        // la validation/assainissement supplémentaire du nom de fichier peut être approprié
        $name = basename($_FILES["photo_publication"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");

    }
    else {
      $image = "none";
    }



$query = $pdo->prepare('INSERT INTO ecrit(titre,contenu, dateEcrit, image, idAuteur, idAmi) VALUES(:titre,:contenu, :dateEcrit, :image, :idAuteur, :idAmi)');
// On lie les variables définie au-dessus au paramètres de la requête préparée
$query->bindValue(':titre', $titre, PDO::PARAM_STR);
$query->bindValue(':contenu', $message, PDO::PARAM_STR);
$query->bindValue(':dateEcrit', $date, PDO::PARAM_STR);
$query->bindValue(':image', $image, PDO::PARAM_STR);
$query->bindValue(':idAuteur', $id, PDO::PARAM_STR);
$query->bindValue(':idAmi', $idAmi, PDO::PARAM_STR);


//On exécute la requête

$query->execute();

if ($_GET['lieu'] == 'compte'){
  header('Location: index.php?action=compte&id='.$idAmi);
}
else {
  header('Location: index.php?action=connected');
}
  }

  else {

    if ($_GET['lieu'] == 'compte'){
      header('Location: index.php?action=pasamis&idAmi='.$idAmi);
    }
    else {
      header('Location: index.php?action=pasamis&idAmi='.$idAmi);
    }
  }
echo "$message";
}

else {
  if ($_GET['lieu'] == 'compte'){
    header('Location: index.php?action=compte&id='.$idAmi);
  }
  else {
    header('Location: index.php?action=connected');
  }
}














 ?>
