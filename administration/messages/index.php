<?php
require_once("../../ressources/includes/connexion-bdd.php");

$requete_brute = "SELECT * FROM message ORDER BY date_creation DESC";
$resultat_brut = mysqli_query($mysqli_link, $requete_brute);

// Compter le nombre de messages
$nombre_messages = mysqli_num_rows($resultat_brut);

$page_courante = "messages";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once("../ressources/includes/head.php"); ?>
    <title>Liste messages - Administration</title>
</head>

<body>
    <?php include_once "../ressources/includes/menu-principal.php"; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-3 px-4">
            <p class="text-3xl font-bold text-gray-900">Liste messages reçus</p>
            <p class="text-gray-500 text-sm">Nombre de messages : <?php echo $nombre_messages; ?></p>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 px-4">
            <div class="py-6">
                <table class="w-full bg-white rounded-lg overflow-hidden border-collapse shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="font-bold pl-8 py-5 text-left">Id</th>
                            <th class="font-bold pl-8 py-5 text-left">Nom</th>
                            <th class="font-bold pl-8 py-5 text-left">Prénom</th>
                            <th class="font-bold pl-8 py-5 text-left">Email</th>
                            <th class="font-bold pl-8 py-5 text-left">Type</th>
                            <th class="font-bold pl-8 py-5 text-left">Date de création</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($element = mysqli_fetch_array($resultat_brut, MYSQLI_ASSOC)) { ?>
                            <tr class="odd:bg-neutral-50 border-b-2 border-b-gray-100 last:border-b-0 first:border-t-2 first:border-t-gray-200">
                                <td class="pl-8 p-4 font-bold" data-label="Id"><?php echo htmlspecialchars($element["id"]); ?></td>
                                <td class="pl-8 p-4" data-label="Nom"><?php echo htmlspecialchars($element["nom"]); ?></td>
                                <td class="pl-8 p-4" data-label="Prénom"><?php echo htmlspecialchars($element["prenom"]); ?></td>
                                <td class="pl-8 p-4" data-label="Email"><?php echo htmlspecialchars($element["email"]); ?></td>
                                <td class="pl-8 p-4" data-label="Type"><?php echo htmlspecialchars($element["type"]); ?></td>
                                <td class="pl-8 p-4" data-label="Date">
                                    <time datetime="<?php echo $element['date_creation']; ?>">
                                        <?php echo date('d/m/Y H:i:s', strtotime($element['date_creation'])); ?>
                                    </time>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php require_once("../ressources/includes/global-footer.php"); ?>
</body>

</html>
