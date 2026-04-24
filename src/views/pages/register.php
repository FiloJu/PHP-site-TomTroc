<h1>Inscription</h1>
<form method="POST" action="index.php?action=register">
    <div>
        <label for="username">Pseudo</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">S'inscrire</button>
</form>
<p>Déjà inscrit ? <a href="index.php?action=login">Connectez-vous</a></p>