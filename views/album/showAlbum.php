<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Photos de l'album</title>
    <link rel="stylesheet" href="water.css">
    <link rel="stylesheet" href="gallery.css">
</head>
<body>

    <h1>Photos de l'album</h1>

    <nav>
        <ul>
            <li><a href="?">← Retour</a></li>
            
        </ul>
    </nav>

    <?php if (empty($photos)): ?>
        <p>Aucune photo dans cet album.</p>
    <?php else: ?>
        
            <?php foreach ($photos as $photo): ?>
                <a href="index.php?url=photo/displayById/<?= $photo['id'] ?>">
                    <img src="<?= htmlspecialchars($photo['filepath']) ?>">
                </a>
            <?php endforeach; ?>
        
    <?php endif; ?>

</body>
</html>
