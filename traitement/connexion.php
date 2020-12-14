<?php



$sql = "SELECT * FROM user WHERE email=? AND mdp=PASSWORD(?)";
// Etape 1  : preparation
$q = $pdo->prepare($sql);
// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute([$_POST['mail'],$_POST['password']]);
// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.
if($line = $q->fetch()){
  $_SESSION['login'] = $line["login"];
  $_SESSION['id'] = $line["id"];
  $_SESSION['mail'] = $line["mail"];
  $_SESSION['avatar'] = $line["avatar"];

  header('Location: index.php?action=connected');
}
// un seul fetch
else {

  header('Location: index.php?action=login&erreur=1');

}

// Si $line est faux le couple login mdp est mauvais, on retourne au formulaire

// sinon on crée les variables de session $_SESSION['id'] et $_SESSION['login'] et on va à la page d'accueil

?>
