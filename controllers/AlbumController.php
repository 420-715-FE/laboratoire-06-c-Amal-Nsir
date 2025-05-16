<?php

require_once(__DIR__ . '/../models/AlbumManager.php');

class AlbumController {
    private $album;

    public function __construct($db) {
        $this->album = new AlbumManager($db);
    }

    
    public function displayAlbums() {
        $albums = $this->album->getAll();

        
        foreach ($albums as $album) {
            
            if (empty($album['album_cover']) || !file_exists(__DIR__ . '/../' . $album['album_cover'])) {
                $album['album_cover'] = 'image_placeholder.png';
            }
        }

        require_once(__DIR__ . '/../views/album/albums.php');
    }

    
    public function displayPhotosByAlbum($albumId) {
        if (empty($albumId) || !is_numeric($albumId)) {
            require_once(__DIR__ . '/../404.php');
            return;
        }

        $photos = $this->album->getPhotosByAlbum($albumId);

        if (!$photos) {
            $photos = []; 
        }

        require_once(__DIR__ . '/../views/album/showAlbum.php');
    }
}
?>