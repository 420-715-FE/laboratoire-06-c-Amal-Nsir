<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Albums</title>
   <link rel="stylesheet" href="water.css">
    <link rel="stylesheet" href="gallery.css">
</head>
<body>

    <h1>Albums</h1>

    <nav>
        <ul> 
            <li><a href="index.php?url=photo/displayGallery">Galerie</a></li>
            <li>Albums</li>
            <li><a href="index.php?url=photo/add">Ajouter une photo</a></li>
            
        </ul>
    </nav>

    <ul id="gallery">
        <?php foreach ($albums as $album): ?>
            <li>
                <a href="index.php?url=album/displayPhotosByAlbum/<?= $album['id'] ?>">
                    <img src="<?= htmlspecialchars($album['album_cover']) ?>" width="200">
                    <p><?= $album["name"] ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
