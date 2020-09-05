<?php

namespace app\controllers;

use app\controllers\interfaces\crudControllerInterface;
use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $params = [
            'info' => 'Coming soon!'
        ];

        return $this->render('home', $params);
    }

    public function contact()
    {
        $params = [
            'info' => 'Coming soon!'
        ];

        return $this->render('contact', $params);
    }
}