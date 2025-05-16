<?php
require_once(__DIR__ . '/../../helpers.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une photo</title>
    <link rel="stylesheet" href="water.css">
    <link rel="stylesheet" href="gallery.css">
</head>
<body>

    <h1>Ajouter une photo</h1>

    <nav>
        <ul>
            <li><a href="?">Retour</a></li>
        </ul>
    </nav>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label for="photo">Choisissez une photo :</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>
        <input type="submit" value="Téléverser">
    </form>

</body>
</html>

