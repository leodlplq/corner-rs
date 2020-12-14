<?php

$idAmi = $_GET['idAmi'];
$id = $_SESSION['id'];

$sqle = "INSERT INTO lien VALUES(NULL,?,?,'attente')";
$query = $pdo->prepare($sqle);
$query->execute(array($id, $idAmi));

  header('Location: index.php?action=connected');




?>
