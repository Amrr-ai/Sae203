# SAÉ 203 - Conception d'un site web avec source de données
## Rapport de projet et d'auto-évaluation

**Membres de l'équipe :**
*   **Emmanuel MBUMBA**
*   **Ammar OSEI-MOHAMEND**
*   **Selyan NAIT SIDI AHMED**

**Hébergement en production :** [https://saesql.alwaysdata.net/code/](https://saesql.alwaysdata.net/code/)
**Dépôt du projet (Git) :** `https://github.com/votre-nom-dutilisateur/votre-depot-sae203` *(A ajuster)*

---

### 1. Qui a fait quoi ? (Répartition des tâches)

Afin de mener à bien ce projet de manière collaborative, nous avons réparti les développements en trois pôles complémentaires :

*   **Ammar OSEI-MOHAMEND :**
    *   Mise en place de l'environnement local (`.env.dev`) et connexion sécurisée à la base de données.
    *   Développement de la page de lecture détaillée des articles (`article.php`) avec intégration dynamique de la vidéo YouTube (format adaptatif 16/9) et gestion de la valeur par défaut pour les auteurs manquants.
    *   Intégration et optimisation des transitions CSS au survol (`:hover`) et au focus clavier (`:focus`) des articles sur la page d'accueil (`accueil.css`).

*   **Emmanuel MBUMBA :**
    *   Développement du Back-Office pour la partie **Auteurs** (liste des auteurs, formulaires de création et d'édition).
    *   Mise en place des requêtes SQL `INSERT INTO` et `UPDATE` pour la persistance des données.
    *   Implémentation des contrôles de saisie en PHP et affichage des messages d'erreur si un champ obligatoire est manquant.
    *   Personnalisation et intégration du footer global de l'administration.

*   **Selyan NAIT SIDI AHMED :**
    *   Développement du Back-Office pour la partie **Articles** (liste des articles, formulaires de création et d'édition) et pour la boîte de réception des **Messages**.
    *   Création de la jointure SQL `LEFT JOIN` avec menu déroulant dynamique dans le formulaire de création/édition d'articles pour associer un auteur existant de la base de données.
    *   Audit de conformité d'accessibilité web sur l'ensemble des pages (utilisation systématique des unités `rem` pour les polices, attributs `alt` sur les images, liaison des `<label>` par les attributs `for` et `id`).

---

### 2. Utilisation de l'IA générative

Dans le cadre de cette SAÉ, nous avons fait appel à un assistant IA de manière ciblée, non pas pour écrire le projet à notre place, mais comme un **compagnon d'apprentissage et de débogage** :

*   **Résolution de bugs complexes :** L'IA nous a aidés à identifier la cause racine du bug 404 dans les boutons du panneau d'administration. Elle nous a expliqué comment la fonction `pathinfo($_SERVER['REQUEST_URI'])` renvoyait un dossier erroné en présence d'un slash de fin d'URL et nous a guidés pour adopter des chemins relatifs stables basés sur la balise `<base>`.
*   **Compréhension de SQL / PHP :** L'assistant nous a permis de mieux assimiler les mécaniques de récupération de résultats en PHP (ex: la différence de structure entre le résultat de `mysqli_query` et l'extraction par `mysqli_fetch_assoc`).
*   **Audit d'accessibilité :** Nous avons utilisé l'IA pour valider la conformité de nos formulaires et de nos styles CSS vis-à-vis des directives RGAA (notamment l'usage strict des unités de police en `rem`).

Cette démarche nous a permis de gagner un temps précieux sur le débogage technique tout en approfondissant notre compréhension du fonctionnement de PHP procédural.

---

### 3. Problèmes rencontrés et limitations de l'application

Bien que le site soit entièrement fonctionnel et conforme aux exigences, il présente quelques limites inhérentes au cadre académique du projet :

*   **Absence d'authentification Back-Office :** Conformément au sujet de la SAÉ, l'administration est accessible directement sans identifiant ni mot de passe. Dans un contexte de production réelle, cette faille de sécurité majeure devrait être résolue par la mise en place d'un système de sessions PHP et de hashage de mots de passe (`password_hash`).
*   **Gestion des images par liens textes :** Pour simplifier l'interaction base de données, les images sont référencées par des URLs absolues. Une véritable application nécessiterait un module d'upload de fichiers sur le serveur (`multipart/form-data`) avec vérification des extensions et redimensionnement automatique.
*   **Pas de validation asynchrone :** Les formulaires (contact, création, édition) nécessitent un rechargement complet de la page pour valider les données en PHP. L'intégration de requêtes AJAX ou de Fetch API aurait permis une expérience utilisateur plus fluide (Single Page Application).
*   **Requêtes SQL procédurales :** Le projet s'appuie sur la bibliothèque `mysqli` avec des injections directes de variables nettoyées par `mysqli_real_escape_string`. L'utilisation d'une interface orientée objet comme PDO avec des requêtes préparées (`prepare` / `execute`) serait plus moderne et plus robuste contre les injections SQL.
