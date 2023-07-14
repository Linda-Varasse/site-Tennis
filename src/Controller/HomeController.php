<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\ContactModel;
use App\Model\ProductsModel;

class HomeController extends AbstractController
{
    public function index()
    {
        $this->render('home.phtml');
    }
    public function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!in_array('', $_POST)) {
                if (isset($_SESSION['user'])) {
                    $contactM = new ContactModel;
                    $contactM->insert($_POST);
                } elseif (array_key_exists('mail', $_POST) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    $contactM = new ContactModel;
                    $contactM->insert($_POST);
                    $_SESSION['success'] = 'Votre message à bien été envoyé';
                    $this->render('home.phtml');
                } else $_SESSION['error'] = 'Email invalide';
            } else $_SESSION['error'] = 'Le formulaire doit être complètement rempli';
        }
        $this->render('contact.phtml');
    }
}
