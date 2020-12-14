<?php

$idAttente = $_GET['idAttente'];


$sqle = "UPDATE lien SET etat = 'ami' WHERE id=?";
$query = $pdo->prepare($sqle);
$query->execute(array($idAttente));

  header('Location: index.php?action=connected');




?>
