<?php
require_once('../../ressources/includes/connexion-bdd.php');

$page_courante = "articles";

// Récupérer la liste des auteurs pour le menu déroulant
$requete_auteurs = "SELECT id, nom, prenom FROM auteur ORDER BY nom ASC, prenom ASC";
$resultat_auteurs = mysqli_query($mysqli_link, $requete_auteurs);

$formulaire_soumis = !empty($_POST);
$erreur = "";

if ($formulaire_soumis) {
    $titre = htmlentities(trim($_POST['titre'] ?? ''));
    $chapo = htmlentities(trim($_POST['chapo'] ?? ''));
    $contenu = htmlentities(trim($_POST['contenu'] ?? ''));
    $image = htmlentities(trim($_POST['image'] ?? ''));
    $lien_yt = htmlentities(trim($_POST['lien_yt'] ?? ''));
    $auteur_id = $_POST['auteur_id'] !== "" ? (int)$_POST['auteur_id'] : "NULL";

    if ($titre === "" || $chapo === "" || $contenu === "" || $image === "") {
        $erreur = "Veuillez remplir tous les champs obligatoires (Titre, Chapô, Contenu, Image).";
    } else {
        $titre_sql = mysqli_real_escape_string($mysqli_link, $titre);
        $chapo_sql = mysqli_real_escape_string($mysqli_link, $chapo);
        $contenu_sql = mysqli_real_escape_string($mysqli_link, $contenu);
        $image_sql = mysqli_real_escape_string($mysqli_link, $image);
        $lien_yt_sql = mysqli_real_escape_string($mysqli_link, $lien_yt);

        $requete_brute = "
            INSERT INTO article (titre, chapo, contenu, image, lien_yt, auteur_id, date_creation) 
            VALUES ('$titre_sql', '$chapo_sql', '$contenu_sql', '$image_sql', '$lien_yt_sql', $auteur_id, NOW())
        ";

        $resultat_brut = mysqli_query($mysqli_link, $requete_brute);

        if ($resultat_brut) {
            // Redirection vers la liste
            $racineURL = pathinfo($_SERVER['REQUEST_URI']);
            $pageRedirection = $racineURL['dirname'];
            header("Location: $pageRedirection");
            exit;
        } else {
            $erreur = "Erreur lors de la création de l'article : " . mysqli_error($mysqli_link);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once("../ressources/includes/head.php"); ?>
    <title>Créer un article - Administration</title>
</head>

<body>
    <?php include_once '../ressources/includes/menu-principal.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-3 px-4">
            <p class="text-3xl font-bold text-gray-900">Créer un nouvel article</p>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 px-4">
            <div class="py-6">
                <?php if ($erreur): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo $erreur; ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="rounded-lg bg-white p-6 shadow border-gray-300 border">
                    <section class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="titre" class="block text-lg font-medium text-gray-700">Titre *</label>
                            <input type="text" name="titre" id="titre" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                        </div>
                        
                        <div>
                            <label for="chapo" class="block text-lg font-medium text-gray-700">Chapô *</label>
                            <textarea name="chapo" id="chapo" required rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2"></textarea>
                        </div>

                        <div>
                            <label for="contenu" class="block text-lg font-medium text-gray-700">Contenu *</label>
                            <textarea name="contenu" id="contenu" required rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="image" class="block text-lg font-medium text-gray-700">Lien de l'image *</label>
                                <input type="url" name="image" id="image" required placeholder="https://..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                            </div>
                            <div>
                                <label for="lien_yt" class="block text-lg font-medium text-gray-700">Lien Vidéo YouTube</label>
                                <input type="url" name="lien_yt" id="lien_yt" placeholder="https://www.youtube.com/embed/..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                            </div>
                        </div>

                        <div>
                            <label for="auteur_id" class="block text-lg font-medium text-gray-700">Auteur</label>
                            <select name="auteur_id" id="auteur_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                                <option value="">Aucun auteur</option>
                                <?php while ($auteur = mysqli_fetch_assoc($resultat_auteurs)): ?>
                                    <option value="<?php echo $auteur['id']; ?>">
                                        <?php echo htmlspecialchars($auteur['nom'] . " " . $auteur['prenom']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="rounded-md bg-indigo-600 py-2 px-6 text-lg font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                                Créer l'article
                            </button>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </main>
    <?php require_once("../ressources/includes/global-footer.php"); ?>
</body>

</html>
