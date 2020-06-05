<?php

namespace Controller;

use Entity\User;

class AuthController
{
    public function login()
    {
        global $userRepo;

        if (isset($_POST['username']) && isset($_POST['password'])) {

            $users = $userRepo->findBy(array("nickname" => $_POST['username']));

            if (count($users) == 1) {

                $user = $users[0];

                if ($user->password != md5($_POST['password'])) {

                    $errorMsg = "Wrong password.";

                    include "../templates/loginform.php";
                } else {

                    $_SESSION['user'] = $users[0];

                    header('Location:/?action=display');
                }
            } else {

                $errorMsg = "Nickname doesn't exist.";

                include "../templates/loginform.php";
            }
        } else {

            include "../templates/loginform.php";
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {

            unset($_SESSION['user']);
        }
        header('Location: ?action=display');
    }

    public function register()
    {
        global $userRepo;
        global $manager;

        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordRetype'])) {

            $errorMsg = NULL;

            $users = $userRepo->findBy(array("nickname" => $_POST['username']));

            if (count($users > 0)) {

                $errorMsg = "Nickname already used.";
            } else if ($_POST['password'] != $_POST['passwordRetype']) {

                $errorMsg = "Passwords are not the same.";
            } else if (strlen(trim($_POST['password'])) < 8) {

                $errorMsg = "Your password should have at least 8 characters.";
            } else if (strlen(trim($_POST['username'])) < 4) {

                $errorMsg = "Your nickame should have at least 4 characters.";
            }

            if ($errorMsg) {

                include "../templates/registerform.php";
            } else {

                $user = new User;

                $user->nickname = $_POST['nickname'];

                $user->password = $_POST['password'];

                $_SESSION['user'] = $user;

                $manager->persist($user);

                $manager->flush();

                header('Location: ?action=register');
            }
        } else {

            include "../templates/registerform.php";
        }
    }
}
