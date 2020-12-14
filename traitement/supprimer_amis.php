<?php


$idAmi = $_GET['id'];


$sqle = "DELETE FROM lien WHERE (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?)";
$query = $pdo->prepare($sqle);
$query->execute(array($idAmi, $_SESSION['id'],$_SESSION['id'], $idAmi));



  header('Location: index.php?action=compte&id='.$idAmi);

?>
