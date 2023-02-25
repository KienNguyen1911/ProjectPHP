<?php

class ImageController extends BaseController {
    
    private $image;
    public function __construct() {
        $this->loadModel('Image');
        $this->image = new Image();
    }

    public function showByMotel() {
        $images = $this->image->findImageByMotel($_GET['id']);
        $this->view('admin.pages.motels.images', ['images' => $images]);
    }

    public function create($idMotel) {
        $this->image->createImage($idMotel);
        header('Location: index.php?controller=motel$action=index' );
    }
    
    public function getFirst() {
        $images = $this->image->getOneImage($_GET['id']);
        return $images;
    }

    public function deleteImage() {
        $this->loadModel('Motel');
        $motel = new Motel();
        $motels = $motel->findMotelByImg($_GET['idImg']);
        $this->image->deleteImage($_GET['idImg'], $motels['motel_id']);
        header('Location: index.php?controller=image&action=showByMotel&id=' . $motels['motel_id']);
    }

    public function addImgMotel() {
        $this->image->createImgMotel($_GET['idMotel']);
        header('Location: index.php?controller=image&action=showByMotel&id=' . $_GET['idMotel']);
    }
}