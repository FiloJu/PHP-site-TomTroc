<h1>Books</h1>
<ul>
    <?php foreach ($books as $book): ?>
        <li>
            <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
            <p>Author: <?= htmlspecialchars($book->getAuthor()) ?></p>
            <p>Description: <?= htmlspecialchars($book->getDescription()) ?></p>
        </li>
    <?php endforeach; ?>
</ul>