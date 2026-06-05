<section class="auth">
    <div class="auth-left">
        <h1 class="sign-title">Inscription</h1>

        <form method="POST" action="index.php?action=createUser">
            <div class="field">
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="field">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="field">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="sign-submit-btn">S'inscrire</button>
        </form>

        <p class="sign-ask">Déjà inscrit ? <a href="index.php?action=login">Connectez-vous</a></p>
    </div>

    <div class="auth-img">
        <img src="img/min/livres.svg" alt="Illustration inscription">
    </div>
</section>