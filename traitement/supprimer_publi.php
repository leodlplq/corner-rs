<?php

$idPubli = $_GET['idPubli'];



$sqle = "DELETE FROM ecrit WHERE idPubli=?";
$query = $pdo->prepare($sqle);
$query->execute(array($idPubli));


if ($_GET['lieu'] == 'compte'){
  header('Location: index.php?action=compte&id='.$_GET['id']);
}
else {
  header('Location: index.php?action=connected');
}







?>
