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

    public function index() // admin motels

    {
        $conn = DbConnect::connect();
        // inner join
        $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name, wards.name as ward_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN wards ON motels.ward_id = wards.id
            WHERE motels.owner_id = " . $_SESSION['user']['id'];

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view(
            'admin.pages.motels.listMotel',
            ['data' => $data]
        );
    }

    public function add() // create motel admin

    {
        $this->loadModel('Attr');
        $attribute = new Attr();
        $attributes = $attribute->show();

        $this->loadModel('Province');
        $province = new Province();
        $provinces = $province->show();

        $motels = $this->motel->show();

        $this->view(
            'admin.pages.motels.addMotel',
            ['provinces' => $provinces, 'motels' => $motels, 'attributes' => $attributes]
        );
    }

    public function create()
    {
        $this->debug($_SESSION['user']['id']);
        if ($_SESSION['user']['role'] == 'owner' || $_SESSION['user']['role'] == 'admin') {
            $attributes = implode(';', $_POST['attribute']);

            $motel = [
                'name' => $_POST['name'],
                'price' => (int) $_POST['price'],
                'description' => $_POST['description'],
                'status' => $_POST['status'],
                'province_id' => $_POST['province'],
                'district_id' => $_POST['district'],
                'ward_id' => $_POST['ward'],
                'attributes' => $attributes,
                'owner_id' => $_SESSION['user']['id'],
            ];
            $id = $this->motel->createMotel($motel);
            $image = new ImageController();
            $image->create($id);
            header('Location: index.php?controller=motel&action=index');
        } else {
            header('Location: index.php?controller=login&action=login');
        }
    }

    public function edit() // edit motel admin

    {
        $motel = $this->motel->find($_GET['id']);
        $attr = explode(';', $motel['attributes']);

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

    public function update()
    {
        $this->debug($_POST);
        $attributes = implode(';', $_POST['attribute']);
        $motel = [
            'name' => $this->validateInput($_POST['name']),
            'price' => (int) $this->validateInput($_POST['price']),
            'description' => $this->validateInput($_POST['description']),
            'status' => $this->validateInput($_POST['status']),
            'province_id' => $this->validateInput($_POST['province']),
            'district_id' => $this->validateInput($_POST['district']),
            'ward_id' => $this->validateInput($_POST['ward']),
            'attributes' => $attributes,
            'id' => $_GET['id']
        ];
        $this->motel->updateMotel($motel);
        header('Location: index.php?controller=motel&action=index');
    }

    public function delete() // delete motel admin

    {
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

    public function showMotelPage() // show motel page

    {
        $conn = DbConnect::connect();

        $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name, wards.name as ward_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN wards ON motels.ward_id = wards.id
            INNER JOIN users ON motels.owner_id = users.id";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $motels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->loadModel('Image');
        $image = new Image();
        $images = $image->show();

        $this->loadModel('User');
        $users = new User();

        $this->loadModel('Province');
        $province = new Province();
        $provinces = $province->show();

        $this->view(
            'motels',
            ['motels' => $motels, 'images' => $images, 'users' => $users, 'provinces' => $provinces]
        );
    }

    public function motelImage($motel)
    {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM images WHERE motel_id = $motel[id] LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        return $image;
    }

    public function motelDetail()
    {
        $conn = DbConnect::connect();

        $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name, wards.name as ward_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN wards ON motels.ward_id = wards.id
            WHERE motels.id = " . $_GET['id'];



        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $motels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $attrMotel = explode(';', $motels[0]['attributes']);

        $this->loadModel('Attr');
        $attribute = new Attr();

        $this->loadModel('Image');
        $image = new Image();
        $images = $image->getAllImage($_GET['id']);

        $this->loadModel('User');
        $users = new User();

        $this->loadModel('Order');
        $order = new Order();
        $orders = $order->getOrderByMotel($_GET['id']);

        $this->view(
            'motel-details',
            ['motels' => $motels, 'images' => $images, 'attrMotel' => $attrMotel, 'attribute' => $attribute, 'users' => $users, 'orders' => $orders]
        );
    }

    public function search()
    {
        $conn = DbConnect::connect();

        $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name, wards.name as ward_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN wards ON motels.ward_id = wards.id
            INNER JOIN users ON motels.owner_id = users.id
            WHERE provinces.id = " . $_POST['province'];

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $motels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->loadModel('Image');
        $image = new Image();
        $images = $image->show();

        $this->loadModel('User');
        $users = new User();

        $this->view(
            'motels',
            ['motels' => $motels, 'images' => $images, 'users' => $users]
        );
    }

    public function searchMotels()
    {
        $conn = DbConnect::connect();

        if ($_POST['motelName'] != '' && $_POST['province'] != '' && $_POST['district'] != '') 
        {
            $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN users ON motels.owner_id = users.id
            WHERE provinces.id = " . $_POST['province'] . " AND districts.id = " . $_POST['district'] . " AND motels.name LIKE '%" . $_POST['motelName'] . "%'";
        } 
        elseif ($_POST['province'] != '' && $_POST['district'] != '') 
        {
            $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN users ON motels.owner_id = users.id
            WHERE provinces.id = " . $_POST['province'] . " AND districts.id = " . $_POST['district'];
        } 
        elseif ($_POST['motelName'] != '' && $_POST['province'] != '') 
        {
            $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN users ON motels.owner_id = users.id
            WHERE provinces.id = " . $_POST['province'] . " AND motels.name LIKE '%" . $_POST['motelName'] . "%'";
        } 
        elseif ($_POST['province'] != '') 
        {
            $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN users ON motels.owner_id = users.id
            WHERE provinces.id = " . $_POST['province'];
        } 
        elseif ($_POST['motelName'] != '') 
        {
            $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN users ON motels.owner_id = users.id
            WHERE motels.name LIKE '%" . $_POST['motelName'] . "%'";
        } 
        else 
        {
            $sql = "SELECT motels.*, provinces.name as province_name, districts.name as district_name
            FROM motels 
            INNER JOIN provinces ON motels.province_id = provinces.id 
            INNER JOIN districts ON motels.district_id = districts.id 
            INNER JOIN users ON motels.owner_id = users.id";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $motels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->loadModel('Image');
        $image = new Image();
        $images = $image->show();

        $this->loadModel('User');
        $users = new User();

        $this->loadModel('Province');
        $province = new Province();
        $provinces = $province->show();

        $this->view(
            'motels',
            ['motels' => $motels, 'images' => $images, 'users' => $users, 'provinces' => $provinces]
        );

    }

}