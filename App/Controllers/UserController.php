<?php


namespace Controllers;


use Core\View;
use Models\User;
use Validator\User\UserCreateVaidate;
use Core\AbsController;

class UserController extends AbsController
{

    public function store (){
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $userValidate = new UserCreateVaidate();

        if ($userValidate->validate($fields) && !$userValidate->checkEmailOnExist($fields['email'])){
            $user = new User();
            $newUser = $user->insert($fields);

            if ($newUser){
                redirect('login');
            } else {
                die('Ошибка при создании пользователя в бд');
            }

        }
        $this->data['data'] = $fields;
        $this->data += $userValidate->getErrors();

        View::render('auth/registration.php', $this->data);
    }

}