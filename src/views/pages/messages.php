<section class="messages-page-wrapper">
    <div class="messages-page-container">
        <div class="messages-header">
            <h1>Messagerie</h1>
            <p>Bienvenue dans votre espace de messagerie. Consultez vos conversations et envoyez de nouveaux messages.</p>
        </div>

        <?php if (!empty($conversations) && is_array($conversations)): ?>
            <div class="conversations-list">
                <?php foreach ($conversations as $senderId => $conv): ?>
                    <div class="conversation-card">
                        <a href="index.php?action=messages&sender_id=<?= htmlspecialchars($senderId) ?>">
                            <div class="conversation-header">
                                <strong><?= htmlspecialchars($conv['sender_username'] ?? 'Utilisateur') ?></strong>
                                <span class="conversation-meta"><?= count($conv['messages']) ?> message(s)</span>
                            </div>
                            <?php if (!empty($conv['messages'])): ?>
                                <?php $last = $conv['messages'][0]; ?>
                                <div class="conversation-last">
                                    <p><?= htmlspecialchars(mb_strimwidth($last['content'], 0, 100, '...')) ?></p>
                                    <time><?= htmlspecialchars($last['created_at']) ?></time>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="messages-actions">
                <a href="index.php?action=create-message" class="button">Nouveau message</a>
            </div>
        <?php else: ?>
            <div class="messages-empty-state">
                <p>Vous n'avez pas encore de messages.</p>
                <a href="index.php?action=create-message" class="button">Nouveau message</a>
            </div>
        <?php endif; ?>

    </div>
</section>
