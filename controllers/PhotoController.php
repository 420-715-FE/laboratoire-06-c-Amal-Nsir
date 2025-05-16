<?php

require_once(__DIR__ . '/../models/PhotoManager.php');
require_once(__DIR__ . '/../helpers.php');

class PhotoController {
    private $photo;

    public function __construct($db = null) {
        if ($db === null) {
            require_once(__DIR__ . '/../Database.php');
            $db = (new Database())->getConnection();
        }
        $this->photo = new PhotoManager($db);
    }

    public function displayGallery() {
        $photos = $this->photo->getAll();
        require_once __DIR__ . '/../views/photo/gallery.php';
    }

    public function displayById($id) {
        if (empty($id) || !is_numeric($id)) {
            require_once(__DIR__ . '/../404.php');
            return;
        }

        $photo = $this->photo->getById($id);

        if (!$photo) {
            require_once(__DIR__ . '/../404.php');
            return;
        }

        require_once(__DIR__ . '/../views/photo/showPhoto.php');
    }

    public function add() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
                $error = "Erreur lors du téléchargement de l'image.";
            } else {
                $file = $_FILES['photo'];
                $filetype = mime_content_type($file['tmp_name']);

                if (!str_starts_with($filetype, 'image/')) {
                    $error = "Le fichier n'est pas une image.";
                } else {
                    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $filename = uuid() . '.' . $extension;
                    $relativePath = 'images/' . $filename;
                    $absolutePath = __DIR__ . '/../' . $relativePath;

                    if (move_uploaded_file($file['tmp_name'], $absolutePath)) {
                        $id = $this->photo->insert($relativePath);

                      
                        header("Location: index.php?url=photo/edit/$id");
                        exit;
                    } else {
                        $error = "Erreur lors du déplacement du fichier.";
                    }
                }
            }

            
            require_once(__DIR__ . '/../views/photo/add.php');
        } else {
            
            require_once(__DIR__ . '/../views/photo/add.php');
        }
    }

    
    public function edit($id) {
        if (empty($id) || !is_numeric($id)) {
            require_once(__DIR__ . '/../404.php');
            return;
        }

        $photo = $this->photo->getById($id);

        if (!$photo) {
            require_once(__DIR__ . '/../404.php');
            return;
        }

        require_once(__DIR__ . '/../views/photo/edit.php');
    }

    
    public function update($id) {
        $description = trim($_POST['description'] ?? '');
        $timestamp = $_POST['timestamp'] ?? null;
        $latitude = $_POST['latitude'] !== '' ? $_POST['latitude'] : null;
        $longitude = $_POST['longitude'] !== '' ? $_POST['longitude'] : null;

        
        if ($timestamp && !isValidTimestamp($timestamp)) {
            $error = "Format de date/heure invalide.";
            $photo = $this->photo->getById($id);
            require_once(__DIR__ . '/../views/photo/edit.php');
            return;
        }

        if ($latitude !== null && !isDecimal($latitude)) {
            $error = "Latitude invalide.";
            $photo = $this->photo->getById($id);
            require_once(__DIR__ . '/../views/photo/edit.php');
            return;
        }

        if ($longitude !== null && !isDecimal($longitude)) {
            $error = "Longitude invalide.";
            $photo = $this->photo->getById($id);
            require_once(__DIR__ . '/../views/photo/edit.php');
            return;
        }

        
        $this->photo->update($id, $description, $timestamp, $latitude, $longitude);

        
        header("Location: index.php?url=photo/displayById/$id");
        exit;
    }

    
    public function delete($id) {
        if (empty($id) || !is_numeric($id)) {
            require_once(__DIR__ . '/../404.php');
            return;
        }

        $this->photo->delete($id);
        header("Location: index.php?url=photo/displayGallery");
        exit;
    }
}
?>
