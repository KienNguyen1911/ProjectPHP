<?php
require('ImageController.php');
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
        $conn = DbConnect::connect();
        // inner join
        $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name, wards.name as ward_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN wards ON motels.ward_id = wards.id";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view(
            'admin.pages.motels.listMotel',
            ['data' => $data]
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

    public function create()
    {
        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";
        $attributes = implode(';', $_POST['attribute']);

        $motel = [
            'name' => $_POST['name'],
            'price' => (int)$_POST['price'],
            'description' => $_POST['description'],
            'status' => $_POST['status'],
            'province_id' => $_POST['province'],
            'district_id' => $_POST['district'],
            'ward_id' => $_POST['ward'],
            'attributes' => $attributes,
        ];
        $id = $this->motel->createMotel($motel);
        $image = new ImageController();
        $image->create($id);
        header('Location: index.php?controller=motel&action=index');
    }

    public function edit() {
        $motel = $this->motel->find($_GET['id']);
        // $this->debug($motel);
        $attr = explode(';', $motel['attributes']);
        // $this->debug($attr);

        $this->loadModel('Attr');
        $attribute = new Attr();
        $attributes = $attribute->show();

        $this->loadModel('Province');
        $province = new Province();
        $provinces = $province->show();

        $this->loadModel('District');
        $district = new District();
        $districts = $district->getDistricts($motel['province_id']);

        $this->loadModel('Ward');
        $ward = new Ward();
        $wards = $ward->getWard($motel['district_id']);

        $this->view(
            'admin.pages.motels.editMotel',
            ['motel' => $motel, 'provinces' => $provinces, 'attributes' => $attributes, 'attr' => $attr, 'districts' => $districts, 'wards' => $wards]
        );
    }

    public function update() {
        $this->debug($_POST);
        $attributes = implode(';', $_POST['attribute']);
        $motel = [
            'name' => $_POST['name'],
            'price' => (int)$_POST['price'],
            'description' => $_POST['description'],
            'status' => $_POST['status'],
            'province_id' => $_POST['province'],
            'district_id' => $_POST['district'],
            'ward_id' => $_POST['ward'],
            'attributes' => $attributes,
            'id' => $_GET['id']
        ];
        $this->motel->updateMotel($motel);
        header('Location: index.php?controller=motel&action=index');
    }

    public function delete() {
        // unlink image by name of image in database
        $this->loadModel('Image');
        $image = new Image();
        $images = $image->getAllImage($_GET['id']);
        foreach ($images as $img) {
            unlink($img['image_name']);
        }
        // delete motel
        $this->motel->delete($_GET['id']);
        header('Location: index.php?controller=motel&action=index');
    }
    
    public function showMotelPage() {
        // motel with image and address
        $conn = DbConnect::connect();

        $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name, wards.name as ward_name, images.image_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN wards ON motels.ward_id = wards.id
            INNER JOIN images ON motels.id = images.motel_id
            WHERE motels.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $motel = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->view(
            'motel',
            ['motel' => $motel]
        );
    }
}