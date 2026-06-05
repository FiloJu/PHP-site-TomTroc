<section class="conversation-page-wrapper">
    <div class="conversation-container">
        <div class="conversation-header">
            <a href="index.php?action=messages" class="back-link">&larr; Retour</a>
            <h2>Conversation avec <?= htmlspecialchars($other_user['username'] ?? 'Utilisateur') ?></h2>
        </div>

        <div class="messages-thread">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <?php $isMine = ($msg['sender_id'] === $current_user_id); ?>
                    <div class="message-row <?= $isMine ? 'mine' : 'theirs' ?>">
                        <div class="message-bubble">
                            <p><?= nl2br(htmlspecialchars($msg['content'])) ?></p>
                            <div class="message-meta">
                                <span class="message-sender"><?= htmlspecialchars($msg['sender_username'] ?? '') ?></span>
                                <time><?= htmlspecialchars($msg['created_at']) ?></time>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun message dans cette conversation.</p>
            <?php endif; ?>
        </div>

        <div class="conversation-reply">
            <form action="index.php?action=create-message" method="POST">
                <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($other_user['id']) ?>">
                <div class="form-group">
                    <textarea name="content" rows="4" required placeholder="Écrire un message..."></textarea>
                </div>
                <button type="submit" class="button">Envoyer</button>
            </form>
        </div>
    </div>
</section>
