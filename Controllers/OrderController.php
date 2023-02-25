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

    public function getOrdersByUserId() {
        $this->loadModel('Order');
        $order = new Order();
        $orders = $order->getOrdersByUserId($_SESSION['user']['id']);

        $this->loadModel('Image');
        $images = new Image();

        $this->loadModel('User');
        $users = new User();

        $this->loadModel('Booking');
        $bookings = new Booking();

        $this->view('orders', ['orders' => $orders, 'images' => $images, 'users' => $users, 'bookings' => $bookings]);
    }
}