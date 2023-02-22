<?php
class MotelController extends BaseController
{

    private $motel;

    public function __construct()
    {
        $this->loadModel('Motel');
        $this->motel = new Motel();
    }

    public function index()
    {
        $this->loadModel('Province');
        $province = new Province();
        $provinces = $province->show();
        $motels = $this->motel->show();
        $this->view(
            'admin.pages.motels.listMotel',
            ['motels' => $motels],
            ['provinces' => $provinces]
        );
    }

    public function add()
    {
        $this->loadModel('Attr');
        $attribute = new Attr();
        $attributes = $attribute->show();

        $this->loadModel('Province');
        $province = new Province();
        $provinces = $province->show();


        // var_dump($provinces);
        $motels = $this->motel->show();

        $this->view(
            'admin.pages.motels.addMotel',
            ['provinces' => $provinces, 'motels' => $motels, 'attributes' => $attributes]
        );
    }
    
}