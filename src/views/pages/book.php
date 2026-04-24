<h1>Livre</h1>
<?php if ($book): ?>
    <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
    <p>Author: <?= htmlspecialchars($book->getAuthor()) ?></p>
    <p>Description: <?= htmlspecialchars($book->getDescription()) ?></p>
<?php else: ?>
    <p>Book not found.</p>
<?php endif; ?>