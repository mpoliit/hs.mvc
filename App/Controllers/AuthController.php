<?php


namespace Controllers;


use Helpers\SessionHelpers;
use Core\AbsController;
use Core\View;
use Models\User;

class AuthController extends AbsController
{

    public function login(){
        View::render('auth/login.php');
    }


    public function registration(){
        View::render('auth/registration.php');
    }

    public function auth(){
        unset($_SESSION['errors']['login']['common']);
        $fields = filter_input_array(INPUT_POST, $_POST, 1);

        $user = new User();

        if($userData = $user->getUserByEmail($fields['email'])){
            if(password_verify($fields['pass'], $userData['pass'])){
                SessionHelpers::setUserData('id', $userData['id']);
                SessionHelpers::setUserData('name', $userData['first_name'] . ' ' . $userData['last_name']);
                redirect('home');
                return;
            } else {
                $_SESSION['errors']['login']['common'] = 'Неверный пароль';
            }
        } else {
            $_SESSION['errors']['login']['common'] = 'Пользователя с такой почтой не существует';
        }
        redirect('login');
    }

    public function logout(){
        SessionHelpers::destroyUserData();
        redirect('login');
    }
}