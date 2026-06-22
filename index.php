<?php
$couleur_bulle_classe = "rose";
$page_active = "index";

require_once('./ressources/includes/connexion-bdd.php');

$requete_brute = "SELECT * FROM article";
$resultat_brut = mysqli_query($mysqli_link, $requete_brute);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="/<?php echo $_ENV['CHEMIN_BASE']; ?>">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - BUT MMI - SAÉ 203</title>

    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/reset.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/fonts.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/global.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/header.css">
    <link rel="stylesheet" href="./ressources/css/ne-pas-modifier/accueil.css">
    <link rel="stylesheet" href="./ressources/css/accueil.css">
</head>

<body>
    <?php require_once('./ressources/includes/top-navigation.php'); ?>
    <?php require_once('./ressources/includes/bulle.php'); ?>

    <main class="conteneur-principal conteneur-1280">
        <h1 class="titre">Articles sur le BUT MMI</h1>

        <section class="colonne">
            <section class="liste-articles">
                <?php while ($article = mysqli_fetch_assoc($resultat_brut)) {
                    $date_creation = new DateTime($article["date_creation"]);
                ?>
                    <a
                        href="article.php?id=<?php echo $article["id"]; ?>"
                        class="article"
                        id="article-<?php echo $article["id"]; ?>"
                    >
                        <div>
                            <img
                                src="<?php echo htmlspecialchars($article["image"]); ?>"
                                alt="<?php echo htmlspecialchars($article["titre"]); ?>"
                            >
                        </div>

                        <section class="textes">
                            <h2 class="titre">
                                <?php echo htmlspecialchars($article["titre"]); ?>
                            </h2>

                            <p class="description">
                                <?php echo htmlspecialchars($article["chapo"]); ?>
                            </p>

                            <p class="date">
                                Publié le
                                <time datetime="<?php echo $date_creation->format('Y-m-d H:i:s'); ?>">
                                    <?php echo $date_creation->format('d/m/Y à H:i:s'); ?>
                                </time>
                            </p>
                        </section>
                    </a>
                <?php } ?>
            </section>

            <a
                class="jpo-banniere"
                title="Ouverture dans un nouvel onglet"
                target="_blank"
                rel="noopener noreferrer"
                href="https://www.cyu.fr/salons-journee-portes-ouvertes"
            >
                <img
                    src="ressources/images/logo-cyu-blanc.png"
                    width="200"
                    class="logo"
                    alt=""
                >

                <section class="textes">
                    <p class="txt-petit">Journée portes ouvertes</p>
                    <p class="txt-grand">
                        27/01/<?php echo date('Y'); ?>,
                        de 10h à 17h
                    </p>
                    <p class="en-savoir-plus">EN SAVOIR PLUS</p>
                </section>
            </a>
        </section>
    </main>

    <?php
        require_once('./ressources/includes/footer.php');
        // mysqli_free_result($resultat_brut);
        // mysqli_close($mysqli_link);
    ?>
</body>

</html>