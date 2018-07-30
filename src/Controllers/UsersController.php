<?php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Interop\Container\ContainerInterface;
use App\Entity\Users;
use App\Repository\UsersRepository as UsersRepository;
use Doctrine\ORM\EntityManager;

class UsersController
{
    protected $ci;

    public function __construct(ContainerInterface $ci) {
        $this->ci = $ci;
    }

    public function createUser(Request $request, Response $response, array $args) {
        $name = $request->getParam('name');
        $surname = $request->getParam('surname');
        $username = $request->getParam('username');
        $password = $request->getParam('password');
        $em =  $this->ci->get('em');
        $result = $em->getRepository(\App\Entity\Users::class)->findOneBy(['username' => $username]);
        if (!empty($result)) {
            echo "Username exist";
        } else {
            $em->getRepository(\App\Entity\Users::class)->signUp($name, $surname, $username, $password);
            return $response->withRedirect('/login');
        }
    }

    public function login(Request $request, Response $response, array $args) {
        $username = $request->getParam('username');
        $password = $request->getParam('password');
        $em =  $this->ci->get('em');
        $verifyUsername = $em->getRepository(\App\Entity\Users::class)->findOneBy(['username' => $username]);
        if($verifyUsername) {
            if(password_verify($password, $verifyUsername->getPassword())){
                $_SESSION['username'] = $verifyUsername->getUsername();
                return $response->withRedirect('/upload');
            } else {
                echo 'Invalid password';
            }
        } else {
            echo "Invalid username";
        }
    }

    public function logOut(Request $request, Response $response, array $args) {
        session_destroy();
        return $response->withRedirect('/login');
    }

}
