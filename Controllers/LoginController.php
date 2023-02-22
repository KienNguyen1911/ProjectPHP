<?php 
class LoginController extends BaseController {

    public function getLogin() {
        $this->view('admin.pages.sign-in');
    }

    public function postLogin() {
        $username = $this->validateInput($_POST['username']);
        $password = $this->validateInput($_POST['password']);
        $password = md5($password);

        $this->loadModel('User');
        $user = new User();
        $check = $user->login($username, $password);

        // var_dump($check);

        if ($check) {
            $_SESSION['user'] = $check;
            // var_dump($_SESSION['user']['username']);
            header('Location: index.php?controller=admin&action=dashboard');
        } else {
            $message = 'Sai tài khoản hoặc mật khẩu';
            $_SESSION['message'] = $message;
            header('Location: index.php?controller=login&action=getLogin');
        }
    }

    public function getSignup() {
        $this->view('admin.pages.sign-up');
    }

    public function postSignup() {
        $username = $this->validateInput($_POST['username']);
        $password = $this->validateInput($_POST['password']);
        $password = md5($password);
        $email = $this->validateInput($_POST['email']);
        $phonenumber = $this->validateInput($_POST['phonenumber']);
        $role = $this->validateInput($_POST['role']);

        $this->loadModel('User');
        $user = new User();
        $user->signup($username, $password, $email, $phonenumber, $role);
        // $this->view('admin.pages.sign-in');
        header('Location: index.php?controller=login&action=getLogin');
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location: index.php?controller=login&action=showFormLogin');
    }
}