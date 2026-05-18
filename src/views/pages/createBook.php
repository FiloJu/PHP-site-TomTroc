<h1>Ajouter un livre</h1>
<form method="POST" action="index.php?action=create-book">
    <div>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" required>
    </div>
    <div>
        <label for="image">URL de l'image</label>
        <input type="text" id="image" name="image">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>
    </div>
    <div>
        <button type="submit">Créer le livre</button>
    </div>
</form>
