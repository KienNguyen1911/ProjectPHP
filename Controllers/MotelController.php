<?php 
class MotelController extends BaseController {

    public function index()
    {
        $this->loadModel('Motel');
        $motel = new Motel();
        $motels = $motel->show();
        $this->view(
            'admin.pages.motels.listMotel',
            ['motels' => $motels]
        );
    }

    public function add()
    {
        $this->view('admin.pages.motels.addMotel');
    }
}