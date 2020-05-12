<?php


namespace Controllers;


use Core\View;
use Helpers\SessionHelpers;
use Models\User;
use Validator\User\UserCreateVaidate;
use Core\AbsController;
use Validator\User\UserUpdateVaidate;
use PHPGangsta_GoogleAuthenticator;

class UserController extends AbsController
{

    public function store (){
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $userValidate = new UserCreateVaidate();

        if ($userValidate->validate($fields) && !$userValidate->checkEmailOnExist($fields['email'])){
            $user = new User();
            $newUser = $user->insert($fields);

            if ($newUser){

                $ga         = new PHPGangsta_GoogleAuthenticator();
                $secret     = $ga->createSecret();
                $qrCodeUel  = $ga->getQRCodeGoogleUrl('hs.mvc', $secret);
                $_SESSION['qr']['secret']       = $secret;
                $_SESSION['qr']['qrCodeUrl']    = $qrCodeUel;
                $_SESSION['qr']['user_id']    = $newUser;


                redirect('2auth');
            } else {
                die('Ошибка при создании пользователя в бд');
            }

        }
        $this->data['data'] = $fields;
        $this->data += $userValidate->getErrors();

        View::render('auth/registration.php', $this->data);
    }

    public function index (){
        $user = new User();

        $this->data['data'] = $user->getUserById($_SESSION['user_data']['id']);
        View::render('user/edit.php', $this->data);
    }

    public function edit(){
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $fields['id'] = $_SESSION['user_data']['id'];

        $user = new User();
        $userValidate = new UserUpdateVaidate();

        if ($userValidate->validate($fields) && !$userValidate->checkUserEmail($fields['email'], $fields['id'])){
            if ($fields['old_pass'] != ''){
                $userData = $user->getUserById($fields['id']);
                if(password_verify($fields['old_pass'], $userData['pass'])){
                    if($userValidate->validate_pass($fields['new_pass'])){
                        unset($fields['old_pass']);
                    } else {
                        $this->data['data'] = $user->getUserById($_SESSION['user_data']['id']);
                        $this->data += $userValidate->getErrors_pass();

                        View::render('user/edit.php', $this->data);
                        exit();
                    }
                } else {
                    $_SESSION['notification'] = [
                        'type' => 'danger',
                        'message' => 'Не верный пароль'
                    ];
                    redirect('user/index');
                }

            } else {
                unset($fields['old_pass'], $fields['new_pass']);
            }
            $user->update($fields);

            $_SESSION['notification'] = [
                'type' => 'success',
                'message' => 'Данные изменены!'
            ];
            SessionHelpers::setUserData('name', $fields['first_name'] . ' ' . $fields['last_name']);

            redirect('');
            exit();
        }
        $this->data['data'] = $user->getUserById($_SESSION['user_data']['id']);
        $this->data += $userValidate->getErrors();


        View::render('user/edit.php', $this->data);
    }
}