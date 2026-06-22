<?php
require_once("../../ressources/includes/connexion-bdd.php");

$page_courante = "auteurs";

$id_present_url = array_key_exists("id", $_GET);

if (!$id_present_url) {
    die("Aucun id d'auteur fourni.");
}

$id = (int) $_GET["id"];

$requete_brute = "SELECT * FROM auteur WHERE id = $id";
$resultat_brut = mysqli_query($mysqli_link, $requete_brute);
$entite = mysqli_fetch_array($resultat_brut, MYSQLI_ASSOC);

if (!$entite) {
    die("Auteur introuvable.");
}

$formulaire_soumis = !empty($_POST);
$erreur = "";

if ($formulaire_soumis) {
    $nom = htmlentities(trim($_POST['nom'] ?? ''));
    $prenom = trim($_POST['prenom'] ?? '');
    $lien_avatar = trim($_POST['lien_avatar'] ?? '');
    $lien_twitter = trim($_POST['lien_twitter'] ?? '');

    if ($nom === "" || $prenom === "" || $lien_avatar === "") {
        $erreur = "Veuillez remplir les champs obligatoires (Nom, Prénom, Avatar).";
    } else {
        $nom_sql = mysqli_real_escape_string($mysqli_link, $nom);
        $prenom_sql = mysqli_real_escape_string($mysqli_link, $prenom);
        $lien_avatar_sql = mysqli_real_escape_string($mysqli_link, $lien_avatar);
        $lien_twitter_sql = mysqli_real_escape_string($mysqli_link, $lien_twitter);

        $requete_update = "
            UPDATE auteur
            SET 
                nom = '$nom_sql',
                prenom = '$prenom_sql',
                lien_avatar = '$lien_avatar_sql',
                lien_twitter = '$lien_twitter_sql'
            WHERE id = $id
        ";

        $resultat_modification = mysqli_query($mysqli_link, $requete_update);

        if ($resultat_modification) {
            header("Location: index.php");
            exit;
        } else {
            $erreur = "Une erreur est survenue lors de la modification : " . mysqli_error($mysqli_link);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("../ressources/includes/head.php"); ?>
    <title>Éditer un auteur - Administration</title>
</head>

<body>
    <?php include_once("../ressources/includes/menu-principal.php"); ?>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-3 px-4">
            <p class="text-3xl font-bold text-gray-900">Éditer "<?php echo htmlspecialchars($entite['prenom'] . ' ' . $entite['nom']); ?>"</p>
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

                <form method="POST" action="" class="rounded-lg bg-white p-6 shadow border border-gray-300">
                    <section class="grid grid-cols-1 gap-6">
                        <input type="hidden" value="<?php echo $entite['id']; ?>" name="id">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nom" class="block text-lg font-medium text-gray-700">Nom *</label>
                                <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($entite['nom']); ?>" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                            </div>
                            <div>
                                <label for="prenom" class="block text-lg font-medium text-gray-700">Prénom *</label>
                                <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($entite['prenom']); ?>" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                            </div>
                        </div>

                        <div>
                            <label for="avatar" class="block text-lg font-medium text-gray-700">Lien avatar *</label>
                            <input type="url" name="lien_avatar" id="avatar" value="<?php echo htmlspecialchars($entite['lien_avatar']); ?>" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                        </div>

                        <div>
                            <label for="lien_twitter" class="block text-lg font-medium text-gray-700">Lien Twitter</label>
                            <input type="url" name="lien_twitter" id="lien_twitter" value="<?php echo htmlspecialchars($entite['lien_twitter']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="rounded-md bg-indigo-600 py-2 px-6 text-lg font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                                Enregistrer les modifications
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
