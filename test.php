<html>

<head>
    <title>Détermination et affichage de la taille de la fenêtre du navigateur</title>
    <meta name=author content="Bernard Chardonneau">
    <meta name=copyleft content="Téléchargement autorisé">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <script>document.cookie = "largeur=" + window.innerWidth + "; expires=0"</script>


<?php
    if (isset ($_COOKIE ['largeur']))
    {
        $largeur = $_COOKIE['largeur'];
    }

    if ($largeur > 1500) {
      echo "plus grands que 1500";
    }
    else {
      echo "plus petit";
    }

?>
</body>

</html>
