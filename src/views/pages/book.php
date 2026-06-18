<section class="book-page-wrapper">
    <?php if ($book): ?>
        <div class="chemin-navigation">
                <a href="index.php?action=books">Nos livres à l'échange</a>
            <span><?= htmlspecialchars($book->getTitle()) ?></span>
        </div>

        <div class="book-content-container">
            <div class="book-cover-section">
                <img src="img/books/<?= htmlspecialchars($book->getImage() ?: 'default_book.png') ?>"
                    alt="<?= htmlspecialchars($book->getTitle()) ?>" class="book-image-detail">
            </div>

            <div class="book-info-section">
                <span class="section-main-title">Détails du livre</span>
                <h1 class="book-main-title"><?= htmlspecialchars($book->getTitle()) ?></h1>
                <p class="book-main-author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                <span class="detail-line-separator"></span>
                <p class="book-main-description"><?= nl2br(htmlspecialchars($book->getDescription())) ?></p>

                <div class="section-owner">Propriétaire</div>
                <div class="owner-card">
                    <div class="avatar-wrapper">
                        <img src="img/avatars/Avatar_default.png" alt="Avatar propriétaire" class="owner-avatar-img">
                    </div>
                    <div class="owner-name-container">
                        <a href="index.php?action=publicProfile&id=<?= htmlspecialchars($owner?->getId()) ?>">
                            <span><?= htmlspecialchars($owner?->getUsername() ?? 'Utilisateur inconnu') ?></span>
                        </a>
                    </div>
                </div>

                <?php if (isset($currentUserId) && $currentUserId === $book->getUserId()): ?>
                    <form method="POST" action="index.php?action=delete-book" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($book->getId()) ?>">
                        <button type="submit" class="btn-outline" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce livre?')">Supprimer ce livre</button>
                    </form>
                <?php endif; ?>

                <?php if ($owner && (!isset($currentUserId) || $currentUserId !== $book->getUserId())): ?>
                    <a href="index.php?action=create-message&receiver_id=<?= htmlspecialchars($owner->getId()) ?>" class="btn">Envoyer un message</a>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="no-results">
            <p>Livre introuvable.</p>
        </div>
    <?php endif; ?>
</section>