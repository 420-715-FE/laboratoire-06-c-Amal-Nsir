<!-- views/photo/show.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la photo</title>
    <link rel="stylesheet" href="water.css">
</head>
<body>

    <h1>Détails de la photo</h1>

    <nav>
        <ul>
            <li><a href="?">Retour</a></li>
        </ul>
    </nav>

    <?php if ($photo): ?>
        <img src="<?= htmlspecialchars($photo['filepath']) ?>" alt="photo" width="300"><br>
        <p><strong>Description:</strong> <?= htmlspecialchars($photo['description']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($photo['timestamp']) ?></p>
        <p><strong>Latitude:</strong> <?= htmlspecialchars($photo['latitude']) ?></p>
        <p><strong>Longitude:</strong> <?= htmlspecialchars($photo['longitude']) ?></p>
        <p><strong>Tags:</strong> <?= htmlspecialchars(implode(', ', $photo['tags'])) ?></p>

        <a href="index.php?url=photo/edit/<?= $photo['id'] ?>">Modifier</a> |
        <a href="index.php?url=photo/delete/<?= $photo['id'] ?>" onclick="return confirm('Supprimer cette photo ?')">Supprimer</a>
    <?php else: ?>
        <p>Photo non trouvée.</p>
    <?php endif; ?>

</body>
</html>
