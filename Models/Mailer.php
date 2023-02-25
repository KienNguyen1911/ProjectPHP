<?php 
class Mailer extends BaseModel {
    public function notifySignUp($user, $email) {
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "ngkien1911@gmail.com";
        $to = $email;
        $subject = "Congratulations! You have successfully signed up";
        $message = "Thank you for signing up. Your username is $user and . Please keep this information safe.
Your account is now active.
username: ${user} 
email: ${email}";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
    }

    public function notifyOrder($user, $email, $order, $total, $motelName, $startDate, $endDate) {
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "ngkien191@gmail.com";
        $to = $email;
        $subject = "Congratulations! You have successfully ordered";
        $message = "Thank you for ordering. Your username is $user and your order is $order . Please keep this information safe.
                    Your account is now active.
                    username: ${user} 
                    email: ${email}
                    order: ${order}
                    total: ${total}
                    motelName: ${motelName}
                    startDate: ${startDate}
                    endDate: ${endDate}"
                    ;
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
    }
}
