<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Mon Site') ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>

    <?php $this->partial('navbar') ?>

    <main class="container">
        <?= $content ?>     <!-- Contenu de la vue -->
    </main>

    <?php $this->partial('footer') ?>

</body>
</html>
