<?php
class BookingController extends BaseController
{
    private $bookings;
    public function __construct()
    {
        $this->loadModel('Booking');
        $this->bookings = new Booking();
    }
    public function create()
    {
        // if booking is existed then update, else create new booking
        $data = [
            'user_id' => $_SESSION['user']['id'],
            'motel_id' => $_GET['id'],
            'start' => $_POST['start'],
            'end' => $_POST['end'],
        ];
        $this->debug($data);

        $booking = $this->bookings->getByUserIdAndMotelId($_SESSION['user']['id'], $_GET['id']);
        if ($booking != null) {
            $this->bookings->updateBooking($booking['id'], $data);
            header('Location: index.php?controller=booking&action=bookingDetails&id='.$booking['id']);
        } else {
            echo "create";
            $id = $this->bookings->create($data);
            header('Location: index.php?controller=booking&action=bookingDetails&id='.$id);
        }
    }

    public function getBookingsByUserId()
    {
        $bookings = $this->bookings->getBookingsByUserId($_SESSION['user']['id']);

        $this->loadModel('Image');
        $images = new Image();

        $this->loadModel('User');
        $users = new User();

        $this->view('bookings', ['bookings' => $bookings, 'images' => $images, 'users' => $users]);
    }

    public function bookingDetails() {
        $booking = $this->bookings->getBookingsByMotelId($_GET['id']);
        // $this->debug($booking[0]);

        $this->loadModel('Image');
        $image = new Image();
        $images = $image->getAllImage($booking[0]['motel_id']);
        // $this->debug($images);

        $this->loadModel('User');
        $owner = new User();
        $owners = $owner->find($booking[0]['owner_id']);
        // $this->debug($owners);

        $this->view('booking-details', ['booking' => $booking, 'images' => $images, 'owners' => $owners]);
    }
}