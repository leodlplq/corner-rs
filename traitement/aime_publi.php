<?php

$idPubli = $_GET['idPubli'];
$id = $_SESSION['id'];




$sqle = "INSERT INTO aime VALUES(NULL,?,?)";
$query = $pdo->prepare($sqle);
$query->execute(array($idPubli, $id));

if ($_GET['lieu'] == 'compte'){
  header('Location: index.php?action=compte&id='.$_GET['idAmi']);
}
else {
  header('Location: index.php?action=connected');
}







 ?>
