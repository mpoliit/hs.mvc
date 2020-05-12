<?php


namespace Validator\User;


use Core\AbsValidator;
use Models\User;

class UserCreateVaidate extends AbsValidator
{
    protected $errors = [
        'first_name_error'  => 'Имя должно содержать минимум 2 символа',
        'last_name_error'   => 'Фамилия должна содержать минимум 2 символа',
        'birthday_error'    => 'День рождения не корректен',
        'email_error'       => 'Почта не корректная',
        'pass_error'        => 'Пароль должна содержать минимум 8 символов'
    ];

    protected $rules = [
        'first_name'  => '/[A-Za-zА-Яа-я]{2,}/',
        'last_name'   => '/[A-Za-zА-Яа-я]{2,}/',
        'birthday'    => '/[\d]{4}-[\d]{2}-[\d]{2}/',
        'email'       => '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/',
        'pass'        => '/[a-zA-Z0-9]{5,}/'
    ];

    public function checkEmailOnExist(string $email)
    {
        $user = new User();
        if($user->getUserByEmail($email)){
            $this->errors = [
                'email_error' => 'Пользователь с такой почтой уже существует'
            ];
            return true;
        }

        return false;
    }
}