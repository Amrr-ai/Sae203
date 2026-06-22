<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$couleur_bulle_classe = "bleu";
$page_active = "equipe";

require_once('./ressources/includes/connexion-bdd.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/<?php echo $_ENV['CHEMIN_BASE']; ?>">
    <meta charset="UTF-8">
    <title>Équipe de rédaction</title>
</head>
<body>
    <h1>Page équipe de rédaction OK</h1>
</body>
</html>