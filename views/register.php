<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <h2>Créer un compte</h2>

    <form action="/register-post" method="post">
        <input type="text" name="name" placeholder="Nom" required
               value="<?= htmlspecialchars($data['name'] ?? '') ?>"><br>

        <input type="text" name="firstname" placeholder="Prénom" required
               value="<?= htmlspecialchars($data['firstname'] ?? '') ?>"><br>

        <input type="text" name="pseudo" placeholder="Pseudo" required
               value="<?= htmlspecialchars($data['pseudo'] ?? '') ?>"><br>

        <input type="date" name="birthdate" placeholder="Date de naissance" required
               value="<?= htmlspecialchars($data['birthdate'] ?? '') ?>"><br>

        <input type="email" name="email" placeholder="Email" required
               value="<?= htmlspecialchars($data['email'] ?? '') ?>"><br>

        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required><br>

        <?php if (isset($_SESSION['form_error'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($_SESSION['form_error']) ?>
            </div>
            <?php unset($_SESSION['form_error']); ?>
        <?php endif; ?>

        <button type="submit">Créer un compte</button>
    </form>

    <a href="/login">Déjà un compte ? Se connecter</a>
</div>
</body>
</html>
