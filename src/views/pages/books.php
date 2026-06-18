<section class="books-page">
    <div class="books-header">
        <h1 class="page-title">Nos livres à l'échange</h1>
        <a href="index.php?action=create-book" class="btn">+ Ajouter un livre</a>
    </div>

    <div class="search-bar">
        <div class="search-section">
            <img src="img/min/search.png" alt="Recherche">
            <input type="text" name="q" placeholder="Rechercher un livre" aria-label="Rechercher un livre">
        </div>
    </div>

    <div class="books-grid">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <a href="index.php?action=book&id=<?= $book->getId() ?>" class="book-card">
                    <div class="book-image">
                        <img src="img/books/<?= htmlspecialchars($book->getImage() ?: 'default_book.png') ?>"
                            alt="<?= htmlspecialchars($book->getTitle()) ?>">
                    </div>
                    <div class="book-info">
                        <h3 class="book-title"><?= htmlspecialchars($book->getTitle()) ?></h3>
                        <p class="book-author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        <p class="book-seller">Vendu par : <a href="index.php?action=publicProfile&id=<?= $book->getUserId() ?>"><?= htmlspecialchars($users[$book->getUserId()]?->getUsername() ?? 'Utilisateur inconnu') ?></a></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                <p>Aucun livre disponible pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</section>