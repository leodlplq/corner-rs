<?php

$idLike = $_GET['idLike'];
$id = $_SESSION['id'];



$sqle = "DELETE FROM aime WHERE id=?";
$query = $pdo->prepare($sqle);
$query->execute(array($idLike));


if ($_GET['lieu'] == 'compte'){
  header('Location: index.php?action=compte&id='.$_GET['idAmi']);
}
else {
  header('Location: index.php?action=connected');
}







 ?>
