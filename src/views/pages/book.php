<h1>Livre</h1>
<?php if ($book): ?>
    <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
    <p>Author: <?= htmlspecialchars($book->getAuthor()) ?></p>
    <p>Description: <?= htmlspecialchars($book->getDescription()) ?></p>
    
    <form method="POST" action="index.php?action=delete-book" style="display:inline;">
        <input type="hidden" name="id" value="<?= htmlspecialchars($book->getId()) ?>">
        <button type="submit" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce livre?')">Supprimer ce livre</button>
    </form>
<?php else: ?>
    <p>Book not found.</p>
<?php endif; ?>