<?php
    if (isset($page_courante) && $page_courante == "index") {
        $mysqli_link->close();
    }
?>
<footer class="border-y border-gray-400 text-center mx-6 py-2 mb-1">
    <p class="font-bold">SAÉ 203 - Concevoir un site web avec une source de données</p>
    <p class="font-bold">MMI <?php echo (date("Y") - 1) . "-" . (date("Y") + 2); ?></p>
    <p>Projet réalisé par :</p>
    <ul class="inline-flex">
        <li class="px-1">Ammar J.</li>
        <li class="px-1">Nom_Equipier_2</li>
        <li class="px-1">Nom_Equipier_3</li>
    </ul>
</footer>