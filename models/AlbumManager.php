<?php
class AlbumManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getAll() {
        $query = $this->db->query("SELECT album.id, album.name, photo.filepath as album_cover FROM album
        LEFT JOIN photo
        ON photo.id = album.featured_photo_id");
        $albums = $query->fetchAll();
        return $albums ?: [];

    }
    public function getPhotosByAlbum($albumId) {

        $query = $this->db->prepare("SELECT p.* FROM photo p
        INNER JOIN album_photo ap ON ap.photo_id = p.id
        WHERE ap.album_id = ?");
        $query->execute([$albumId]);
        return $query->fetchAll();
    }

}
?>
