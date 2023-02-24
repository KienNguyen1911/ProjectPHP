<?php 
class OrderController extends BaseController {

    private $orders;

    public function __construct() {
        $this->loadModel('Order');
        $this->orders = new Order();
    }

    public function create() {
        $data = [
            'booking_id' => $_GET['idBooking'],
            'total' => $_POST['total'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->orders->createOrder($data);
        header('Location: index.php?controller=booking&action=getOrdersByUserId');
    }
}