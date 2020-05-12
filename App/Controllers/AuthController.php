<?php


namespace Controllers;


use Helpers\SessionHelpers;
use Core\AbsController;
use Core\View;
use Models\User;
use PHPGangsta_GoogleAuthenticator;

class AuthController extends AbsController
{

    public function login()
    {
        View::render('auth/login.php');
    }

    public function registration()
    {
        View::render('auth/registration.php');
    }

    public function auth()
    {
        unset($_SESSION['errors']['login']['common']);
        $fields = filter_input_array(INPUT_POST, $_POST, 1);

        $user = new User();

        if($userData = $user->getUserByEmail($fields['email'])){
            if(password_verify($fields['pass'], $userData['pass'])){
                $_SESSION['2auth'] = [
                    'user_id'       => $userData['id'],
                    'secret'        => $userData['secret_key'],
                    'first_name'    => $userData['first_name'],
                    'last_name'    => $userData['last_name']
                ];
                View::render('auth/enter_code.php');

                exit();
            } else {
                $_SESSION['errors']['login']['common'] = 'Неверный пароль';
            }
        } else {
            $_SESSION['errors']['login']['common'] = 'Пользователя с такой почтой не существует';
        }
        redirect('login');
    }

    public function verify2auth()
    {
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        if (!empty($fields['qr-code']) && !empty($_SESSION['2auth']['user_id']) && !is_null($_SESSION['2auth']['secret'])){
            $ga = new PHPGangsta_GoogleAuthenticator();
            $check = $ga->verifyCode($_SESSION['2auth']['secret'], $fields['qr-code']);

            if ($check){
                SessionHelpers::setUserData('id', $_SESSION['2auth']['user_id']);
                SessionHelpers::setUserData('name', $_SESSION['2auth']['first_name'] . ' ' . $_SESSION['2auth']['last_name']);
                redirect('');
                exit();
            }
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Не верный код!'
            ];
            redirect('login');
            exit();
        }
        redirect('login');

    }

    public function showQr()
    {
        if(isset($_SESSION['qr']['qrCodeUrl'])){
            View::render('auth/qr_code.php', ['qrCodeUrl' => $_SESSION['qr']['qrCodeUrl']]);
            exit();
        }
        redirect('login');
    }

    public function verifiAuth()
    {
        if (!empty($_SESSION['qr']['secret']) && !empty($_SESSION['qr']['user_id'])){
            $user = new User();
            $userData = $user->insertSecretKey();
        }
        unset($_SESSION['qr']);
        redirect('login');
    }

    public function showCodeQr()
    {
        if(!empty($_SESSION['2auth'])){
            View::render('auth/enter_code.php');
        }
        redirect('login');
    }

    public function logout()
    {
        SessionHelpers::destroyUserData();
        redirect('login');
    }
}