<?php
namespace Coindb\Controllers;

use \FrameWork\DatabaseTable;

class Register
{
    private $usersTable;

    public function __construct(DatabaseTable $usersTable)
    {
        $this -> usersTable = $usersTable;
    }

    public function registrationForm()
    {
        return ['template' => 'register.html.php',
        'title' => 'Register User'];
    }

    public function success()
    {
        return ['template' => 'registersuccess.html.php', 'title' => 'Your account is registered!'];
    }

    public function registerUser()
    {
        $user = $_POST['user'];

        $valid = true;

        $errors = [];

        

        if (empty($user['name'])) {
            $valid = false;
            $errors[] = 'A name is a required field';
        }

        if (empty($user['email'])) {
            $valid = false;
            $errors[] = 'An email is a required field';
        } elseif (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = 'It\' unvalide email address';
        } else {
            $user['email'] = strtolower($user['email']);
        }

        if (count($this-> usersTable -> find('email', $user['email']))>0) {
            $valid = false;
            $errors[] = 'You already have an account';
        }

        if (empty($user['password'])) {
            $valid = false;
            $errors[] = 'A password is a required field';
        }

        if ($valid == true) {
            $user['password'] = \password_hash($user['password'], PASSWORD_DEFAULT);

            $this -> usersTable -> save($user);

            header('Location: /user/success');
        } else {
            return['template' => 'register.html.php', 'title' => 'Register User',
            'variables' => [
                'errors' => $errors,
                'user' => $user
                ]
            ];
        }
    }
}