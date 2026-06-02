<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!--
        Ici, j'affiche le titre de la page dans l'onglet du navigateur.

        La variable $title peut être envoyée depuis le contrôleur
        avec la méthode render().

        Si aucun titre n'est défini, alors j'affiche par défaut "Projet Web".

        htmlspecialchars() permet de sécuriser l'affichage du titre
        pour éviter qu'un code HTML ou JavaScript soit exécuté.
    -->
    <title><?= htmlspecialchars($title ?? 'Projet Web') ?></title>
</head>
<body>

<!--
    Ici, je crée la barre de navigation du site.

    Cette partie est placée dans le header parce qu'elle doit apparaître
    sur plusieurs pages du site.
-->
<nav>
    <!--
        Liens principaux du site.

        Chaque lien envoie une valeur différente dans l'URL avec ?page=...
        Le routeur va ensuite utiliser cette valeur pour savoir
        quelle page afficher.
    -->
    <a href="?page=home">Accueil</a> |
    <a href="?page=about">À propos</a> |
    <a href="?page=member_area">Espace membre</a> |
    <a href="?page=blog">Blog / News</a> |

    <?php

    // Ici, je vérifie si l'utilisateur est connecté.
    //
    // Si $_SESSION['user'] existe, cela veut dire qu'une session active
    // est enregistrée pour l'utilisateur.
    if (isset($_SESSION['user'])):

    ?>

        <!--
            Si l'utilisateur est connecté,
            j'affiche un message de bienvenue avec son pseudo.

            htmlspecialchars() permet de sécuriser l'affichage du pseudo.
            Cela évite qu'un pseudo contenant du code HTML ou JavaScript
            puisse être exécuté dans la page.
        -->
        Bonjour <?= htmlspecialchars($_SESSION['user']['username']) ?> |

        <a href="?page=chat">Mini-chat</a> |

        <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
            <a href="?page=admin">Administration</a> |
            <a href="?page=users">Utilisateurs</a> |
        <?php endif; ?>

        <!--
            Ce lien permet à l'utilisateur connecté
            d'aller modifier les informations de son profil.
        -->
        <a href="?page=profile">Modifier profil</a> |

        <!--
            Ce lien permet à l'utilisateur connecté
            de se déconnecter de son compte.
        -->
        <a href="?page=logout">Déconnexion</a>

    <?php

    // Si l'utilisateur n'est pas connecté,
    // j'affiche les liens pour s'inscrire ou se connecter.
    else:

    ?>

        <!--
            Ce lien permet au visiteur d'aller vers le formulaire d'inscription.
        -->
        <a href="?page=register">Inscription</a> |

        <!--
            Ce lien permet au visiteur d'aller vers le formulaire de connexion.
        -->
        <a href="?page=login">Connexion</a>

    <?php

    // Fin de la condition qui vérifie si l'utilisateur est connecté ou non.
    endif;

    ?>
</nav>

<!--
    Cette ligne horizontale sert simplement à séparer visuellement
    le menu du contenu principal de la page.
-->
<hr>
