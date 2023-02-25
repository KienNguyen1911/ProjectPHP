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
        
        if ($check) {
            $_SESSION['user'] = $check;
            $this->debug($_SESSION['user']);
            if (self::isAdmin() || self::isOwner()) {
                header('Location: index.php?controller=admin&action=dashboard');
            } else {
                header('Location: index.php?controller=page&action=index');
            }
        } else {
            $message = 'Sai tài khoản hoặc mật khẩu';
            $_SESSION['message'] = $message;
            header('Location: index.php?controller=page&action=login');
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
        $id = $user->signup($username, $password, $email, $phonenumber, $role);

        $user = $user->find($id);
        $this->debug($user);


        $this->loadModel('Mailer');
        $mailer = new Mailer();
        $mailer->notifySignUp($username, $email);

        header('Location: index.php?controller=login&action=getLogin');
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location: index.php?controller=login&action=showFormLogin');
    }

    public function isAdmin() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] == "admin") {
                return true;
            }
        }
        return false;
    }

    public function isOwner() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] == "owner") {
                return true;
            }
        }
        return false;
    }

    public function signOut () {
        unset($_SESSION['user']);
        header('Location: index.php?controller=page&action=login');
    }
}