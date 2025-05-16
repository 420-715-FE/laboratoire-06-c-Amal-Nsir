<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Galerie de photos</title>
   <link rel="stylesheet" href="water.css">
    <link rel="stylesheet" href="gallery.css">
</head>
<body>

    <h1>Galerie de photos</h1>

    <nav>
        <ul> 
            <li>Galerie</li>
            <li><a href="index.php?url=album/displayAlbums">Albums</a></li>
            <li><a href="index.php?url=photo/add">Ajouter une photo</a></li>
            
        </ul>
    </nav>

    <ul id="gallery">
        <?php foreach ($photos as $photo): ?>
            <li>
                <a href="index.php?url=photo/displayById/<?= $photo['id'] ?>">
                    <img src="<?= htmlspecialchars($photo['filepath']) ?>" alt="photo" width="200">
                    <p><?= $photo['description'] ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
