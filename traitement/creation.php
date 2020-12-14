<?php
$email = $_POST['mail'];
$mdp = $_POST['pwd'];
$login = $_POST['prenom'];
$avatar = 'images/photo_profil/unknown.png';
$uploads_dir = 'images/photo_profil/';
$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';


    if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
      var_dump($_FILES["avatar"]["error"]);
        $tmp_name = $_FILES["avatar"]["tmp_name"];
        // basename() peut empêcher les attaques de système de fichiers;
        // la validation/assainissement supplémentaire du nom de fichier peut être approprié
        $name = basename($_FILES["avatar"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $avatar = 'images/photo_profil/'.$_FILES['avatar']['name'];

    }



	if (isset($_POST['mail']) && preg_match($regex, $email)){
    $query = $pdo->prepare('INSERT INTO user(login, mdp, email, avatar) VALUES(:login,PASSWORD(:mdp),:email, :avatar)');
    // On lie les variables définie au-dessus au paramètres de la requête préparée
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':avatar', $avatar, PDO::PARAM_STR);
    //On exécute la requête

    $query->execute();

    header('Location: index.php?action=login');
  }
  else{
    header('Location: index.php?action=register&erreur=mail');


    }









//On prépare la requête




 ?>
