<?php

class ImageController extends BaseController {
    
    private $image;
    public function __construct() {
        $this->loadModel('Image');
        $this->image = new Image();
    }

    public function index() {
        $images = $this->image->show();
        $this->view('admin.pages.images.listImage', ['images' => $images]);
    }

    public function create($idMotel) {
        $this->image->createImage($idMotel);
        header('Location: index.php?controller=motel$action=index' );
    }
    
}