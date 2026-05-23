<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Inscription</h1>

<form method="POST" action="?page=register_store">
    <div>
        <label for="first_name">Prénom</label><br>
        <input type="text" id="first_name" name="first_name" required>
    </div>

    <br>

    <div>
        <label for="last_name">Nom</label><br>
        <input type="text" id="last_name" name="last_name" required>
    </div>

    <br>

    <div>
        <label for="address">Adresse</label><br>
        <input type="text" id="address" name="address" required>
    </div>

    <br>

    <div>
        <label for="postal_code">Code postal</label><br>
        <input type="text" id="postal_code" name="postal_code" required>
    </div>

    <br>

    <div>
        <label for="birth_date">Date de naissance</label><br>
        <input type="date" id="birth_date" name="birth_date" required>
    </div>

    <br>

    <div>
        <label for="email">Adresse email</label><br>
        <input type="email" id="email" name="email" required>
    </div>

    <br>

    <div>
        <label for="username">Pseudo / login</label><br>
        <input type="text" id="username" name="username" required>
    </div>

    <br>

    <div>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" required>
    </div>

    <br>

    <button type="submit">S’inscrire</button>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>