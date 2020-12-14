<?php
$id = $_GET['id'];
$login = $_POST['prenom'];
$avatar = 'images/photo_profil/'.$_FILES['avatar']['name'];

$uploads_dir = 'images/photo_profil/';





if (isset($login)) {
  $sqle = "UPDATE user SET login = ? WHERE id=?";
  $query = $pdo->prepare($sqle);
  $query->execute(array($login, $id));
}


if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
    $_SESSION['avatar'] = $avatar;
    var_dump($_FILES["avatar"]["error"]);
    $tmp_name = $_FILES["avatar"]["tmp_name"];
    // basename() peut empêcher les attaques de système de fichiers;
    // la validation/assainissement supplémentaire du nom de fichier peut être approprié
    $name = basename($_FILES["avatar"]["name"]);
    move_uploaded_file($tmp_name, "$uploads_dir/$name");

    $sqle = "UPDATE user SET avatar = ?  WHERE id=?";
    $query = $pdo->prepare($sqle);
    $query->execute(array($avatar,$id));

}



    header('Location: index.php?action=compte&id='.$id);






 ?>
