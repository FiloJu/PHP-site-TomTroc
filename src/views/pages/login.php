<h1>Connexion</h1>
<form method="POST" action="index.php?action=login">
    <div>
        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Se connecter</button>
</form>
<p>Pas de compte ? <a href="index.php?action=register">Inscrivez-vous</a></p>