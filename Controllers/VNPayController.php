<?php
class VNPayController extends BaseController
{

    public function getVnpay()
    {
        $this->loadModel('Booking');
        $bookings = new Booking();
        $booking = $bookings->find($_GET['id']);
        $_POST = [
            'total' => $_POST['total'],
            'booking_id' => $_GET['id'],
        ];

        $this->view('vnpay_php/vnpay_pay', ['data' => $_POST, 'booking' => $booking]);
    }

    public function postVnpay()
    {
        require_once('Views/vnpay_php/config.php');
        $vnp_Returnurl = "http://localhost/ProjectPHP/index.php?controller=VNPay&action=returnVnpay";

        $vnp_TxnRef = $_GET['id']; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $_POST['amount']; // Số tiền thanh toán
        $vnp_Locale = $_POST['language']; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $_POST['bankCode']; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
        // vui lòng tham khảo thêm tại code demo
    }

    public function returnVnpay()
    {
        require_once('Views/vnpay_php/config.php');
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $data = [
            'booking_id' => $inputData['vnp_TxnRef'],
            'total' => $inputData['vnp_Amount'],
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->loadModel('Booking');
        $bookings = new Booking();
        $booking = $bookings->find($inputData['vnp_TxnRef']);

        $this->loadModel('Order');
        $orders = new Order();
        $idOrder = $orders->createOrder($data);

        $this->loadModel('Motel');
        $motels = new Motel();
        $motel = $motels->find($booking['motel_id']);

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $this->view('vnpay_php/vnpay_return', ['data' => $inputData, 'order' => $idOrder, 'motel' => $motel, 'booking' => $booking]);
    }
}