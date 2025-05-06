<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
    <h2>Connexion</h2>

    <form action="/login-attempt" method="post">
        <input type="email" name="email" placeholder="Email" required
               value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '') ?>">

        <input type="password" name="password" placeholder="Password" required>

        <?php if (isset($_SESSION['form_error'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($_SESSION['form_error']) ?>
            </div>
            <?php unset($_SESSION['form_error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['form_succes'])): ?>
            <div class="succes-message">
                <?= htmlspecialchars($_SESSION['form_succes']) ?>
            </div>
            <?php unset($_SESSION['form_succes']); ?>
        <?php endif; ?>

        <button type="submit">Login</button>
    </form>

    <a href="/register" class="link">Create Account</a>
</div>

<?php unset($_SESSION['old']); ?>
</body>
</html>