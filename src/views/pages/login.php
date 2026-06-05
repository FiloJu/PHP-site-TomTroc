<section class="auth">
    <div class="auth-left">
        <h1 class="sign-title">Connexion</h1>

        <form method="POST" action="index.php?action=login">
            <div class="field">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="field">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="sign-submit-btn">Se connecter</button>
        </form>

        <p class="sign-ask">Pas de compte ? <a href="index.php?action=register">Inscrivez-vous</a></p>
    </div>

    <div class="auth-img">
        <img src="img/min/livres.svg" alt="Illustration connexion">
    </div>
</section>