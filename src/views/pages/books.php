<h1>Livres</h1>
<a href="index.php?action=create-book">
    + Ajouter un livre
</a>

<ul>
    <?php foreach ($books as $book): ?>
        <li>
            <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
            <p>Author: <?= htmlspecialchars($book->getAuthor()) ?></p>
            <p>Description: <?= htmlspecialchars($book->getDescription()) ?></p>
        </li>
    <?php endforeach; ?>
</ul>