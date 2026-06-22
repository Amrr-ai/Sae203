<?php
$couleur_bulle_classe = "bleu";
$page_active = "equipe";

require_once('./ressources/includes/connexion-bdd.php');

$requete = "
    SELECT
        auteur.id,
        auteur.prenom,
        auteur.nom,
        auteur.lien_twitter,
        auteur.lien_avatar,
        COUNT(article.id) AS nombre_articles
    FROM auteur
    LEFT JOIN article ON article.auteur_id = auteur.id
    GROUP BY auteur.id, auteur.prenom, auteur.nom, auteur.lien_twitter, auteur.lien_avatar
    ORDER BY auteur.nom ASC, auteur.prenom ASC
";

$resultat = mysqli_query($mysqli_link, $requete);

if (!$resultat) {
    die('Erreur SQL : ' . mysqli_error($mysqli_link));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/<?php echo $_ENV['CHEMIN_BASE']; ?>">
    <link rel="icon" href="./ressources/images/logo-cyu-couleur.svg" type="image/svg+xml">
    <link rel="icon" href="./ressources/images/logo-cyu-couleur.svg" type="image/svg+xml">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Équipe de rédaction - SAÉ 203</title>

    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/reset.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/fonts.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/global.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/header.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/accueil.css">
    <link rel="stylesheet" href="./ressources/css/accueil.css">
    <link rel="stylesheet" href="./ressources/css/equipe-redaction.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php require_once('./ressources/includes/top-navigation.php'); ?>
    <?php require_once('./ressources/includes/bulle.php'); ?>

    <main class="conteneur-principal conteneur-1280 mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-12 text-center">Équipe de rédaction</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ($auteur = mysqli_fetch_assoc($resultat)) { ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 duration-300 border border-gray-100 p-6 flex flex-col items-center text-center">
                    <div class="relative mb-6">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-blue-100 shadow-inner bg-gray-50">
                            <?php if (!empty($auteur['lien_avatar'])) { ?>
                                <img
                                    src="<?php echo htmlspecialchars($auteur['lien_avatar']); ?>"
                                    alt="Portrait de <?php echo htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom']); ?>"
                                    class="w-full h-full object-cover"
                                >
                            <?php } else { ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 mb-1">
                        <?php echo htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom']); ?>
                    </h2>
                    
                    <p class="text-blue-600 font-medium mb-4">
                        <?php echo $auteur['nombre_articles']; ?> article<?php echo $auteur['nombre_articles'] > 1 ? 's' : ''; ?> publié<?php echo $auteur['nombre_articles'] > 1 ? 's' : ''; ?>
                    </p>

                    <?php if (!empty($auteur['lien_twitter']) && $auteur['lien_twitter'] !== 'A REMPLACER') { ?>
                        <a 
                            href="<?php echo htmlspecialchars($auteur['lien_twitter']); ?>" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full transition-colors duration-200"
                        >
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            Twitter
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </main>

    <?php require_once('./ressources/includes/footer.php'); ?>
</body>
</html>
