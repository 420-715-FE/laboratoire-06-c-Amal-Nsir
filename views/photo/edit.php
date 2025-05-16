<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la photo</title>
    <link rel="stylesheet" href="water.css">
    <link rel="stylesheet" href="gallery.css">
</head>
<body>

    <h1>Modifier la photo</h1>

    <nav>
        <ul>
            <li><a href="index.php?url=photo/displayGallery">Galerie</a></li>
        </ul>
    </nav>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <img src="<?= htmlspecialchars($photo['filepath'] ?? '') ?>" alt="Photo" style="max-width:300px;">

    <form method="POST" action="index.php?url=photo/update/<?= $photo['id'] ?>">
        <input type="hidden" name="id" value="<?= $photo['id'] ?>">

        <label for="description">Description :</label>
        <input type="text" id="description" name="description" 
               value="<?= htmlspecialchars($photo['description'] ?? '') ?>">

        <label for="timestamp">Date et heure :</label>
        <input type="datetime-local" id="timestamp" name="timestamp"
               value="<?= !empty($photo['timestamp']) ? date('Y-m-d\TH:i', strtotime($photo['timestamp'])) : '' ?>">

        <label for="latitude">Latitude :</label>
        <input type="number" step="any" id="latitude" name="latitude"
               value="<?= htmlspecialchars($photo['latitude'] ?? '') ?>">

        <label for="longitude">Longitude :</label>
        <input type="number" step="any" id="longitude" name="longitude"
               value="<?= htmlspecialchars($photo['longitude'] ?? '') ?>">

        <input type="submit" value="Enregistrer les modifications">
    </form>

</body>
</html>
