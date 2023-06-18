<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\UserModel;

class UserController extends AbstractController
{
    private UserModel $userM;

    public function __construct()
    {
        $this->userM = new UserModel;
    }
    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!in_array("", $_POST)) {
                if (array_key_exists('mail', $_POST) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    if (!$this->userM->findByEmail($_POST['mail'])) {
                        // Insert User
                        $this->userM->insert($_POST);
                        // Norification de succès
                        $_SESSION['success'] = 'Vous êtes à présent enregistré';
                        // Redirection vers login
                        $this->render('login.phtml');
                    } else $_SESSION['error'] = 'Un utilisateur existe déjà avec cet email';
                } else $_SESSION['error'] = 'Email invalide';
            } else $_SESSION['error'] = 'Le formulaire doit être complètement rempli';
        }
        $this->render('register.phtml');
    }
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!in_array("", $_POST)) {
                if (array_key_exists('mail', $_POST) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    if ($user = $this->userM->findByEmail($_POST['mail'])) {
                        if (password_verify($_POST['pwd'], $user['password'])) {
                            $_SESSION['user'] = [
                                'id'        => $user['id_user'],
                                'pseudo'    => $user['pseudo'],
                                'email'     => $_POST['mail'],
                                'created'   => $user['created_at'],
                                'role'      => $user['role_id'] == 0 ? 'user' : 'admin',
                                'token'     => bin2hex(random_bytes(32))
                            ];
                            $_SESSION['success'] = 'Vous êtes bien connecté';
                            $this->render('home.phtml');
                        } else $_SESSION['error'] = 'Erreur : Mot de passe invalide';
                    } else $_SESSION['error'] = 'Erreur : Cet utilisateur n\'existe pas';
                } else $_SESSION['error'] = 'Erreur : Email invalide';
            } else $_SESSION['error'] = 'Erreur : Le formulaire doit être complètement rempli';
        }
        $this->render('login.phtml');
    }
    public function logout()
    {
        // Déconnecter le user
        unset($_SESSION['user']);
        // Notification de succès
        $_SESSION['success'] = 'Vous êtes bien déconnecté';
        // Template default
        $this->render('home.phtml');
    }
}
