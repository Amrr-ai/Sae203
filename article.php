<?php
$couleur_bulle_classe = "rose";
$page_active = "index";

require_once('./ressources/includes/connexion-bdd.php');

// 1. Récupérer l'id de l'article dans l'URL, par exemple article.php?id=3
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
} else {
    $id = 0;
}

// 2. Si l'id est invalide, on arrête tout
if ($id <= 0) {
    die("Article introuvable.");
}

// 3. Requête pour récupérer l'article + l'auteur
$requete_brute = "
    SELECT article.*, auteur.prenom AS auteur_prenom, auteur.nom AS auteur_nom
    FROM article
    LEFT JOIN auteur ON article.auteur_id = auteur.id
    WHERE article.id = $id
";
$resultat_brut = mysqli_query($mysqli_link, $requete_brute);
$entite = mysqli_fetch_array($resultat_brut, MYSQLI_ASSOC);

// 4. Si aucun article trouvé, on affiche un message
if (!$entite) {
    die("Article introuvable.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/<?php echo $_ENV['CHEMIN_BASE']; ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($entite["titre"]); ?> - SAÉ 203</title>

    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/reset.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/fonts.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/global.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/header.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/accueil.css">

    <link rel="stylesheet" href="./ressources/css/accueil.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php require_once('./ressources/includes/top-navigation.php'); ?>
    <?php require_once('./ressources/includes/bulle.php'); ?>

    <!-- Contenu principal de la page article -->
    <main class="conteneur-principal conteneur-1280 !max-w-4xl mx-auto px-4 py-8">

        <article>
            <!-- Titre de l'article -->
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <?php echo htmlspecialchars($entite["titre"]); ?>
            </h1>

            <div class="flex items-center text-gray-500 mb-8 space-x-4">
                <!-- Auteur -->
                <span class="font-medium">
                    <?php
                        $auteur = "";
                        if (!empty($entite["auteur_prenom"])) {
                            $auteur .= $entite["auteur_prenom"] . " ";
                        }
                        if (!empty($entite["auteur_nom"])) {
                            $auteur .= $entite["auteur_nom"];
                        }
                        $auteur = trim($auteur);
                        if ($auteur !== "") {
                            echo "Par " . htmlspecialchars($auteur);
                        } else {
                            echo "Par Auteur inconnu";
                        }
                    ?>
                </span>
                <span>•</span>
                <!-- Date de création -->
                <time datetime="<?php echo $entite["date_creation"]; ?>">
                    <?php
                        $date = new DateTime($entite["date_creation"]);
                        echo 'Publié le ' . $date->format('d/m/Y');
                    ?>
                </time>
            </div>

            <!-- Image de l'article (si présente) -->
            <?php if (!empty($entite["image"])) : ?>
                <div class="mb-8 overflow-hidden rounded-xl shadow-lg">
                    <img
                        src="<?php echo htmlspecialchars($entite["image"]); ?>"
                        alt="<?php echo htmlspecialchars($entite["titre"]); ?>"
                        class="w-full h-auto object-cover max-h-[500px]"
                    >
                </div>
            <?php endif; ?>

            <!-- Chapô -->
            <div class="text-xl font-semibold text-gray-800 mb-6 leading-relaxed border-l-4 border-rose-500 pl-4">
                <?php echo nl2br(htmlspecialchars($entite["chapo"])); ?>
            </div>

            <!-- Contenu -->
            <div class="prose prose-lg max-w-none text-gray-700 leading-loose mb-12">
                <?php echo nl2br(htmlspecialchars($entite["contenu"])); ?>
            </div>

            <!-- Vidéo YouTube (si présente) -->
            <?php if (!empty($entite["lien_yt"])) : ?>
                <div class="mt-12 bg-gray-100 p-4 rounded-xl">
                    <h2 class="text-2xl font-bold mb-4">Vidéo associée</h2>
                    <div class="aspect-video w-full rounded-lg overflow-hidden shadow-md">
                        <iframe
                            src="<?php echo htmlspecialchars($entite["lien_yt"]); ?>"
                            title="Vidéo YouTube"
                            class="w-full h-full"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            <?php endif; ?>
        </article>

    </main>

    <?php require_once('./ressources/includes/footer.php'); ?>
</body>
</html>
