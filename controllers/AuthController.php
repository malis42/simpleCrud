<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Client;

class AuthController extends Controller
{
    public function login()
    {
        //$this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $client = new Client();

        if($request->isPost()){
            $client->loadData($request->getBody());

            if($client->validate() && $client->save()){
                Application::$app->session->setFlash('success', 'Client created successfully! You can login now!');
                Application::$app->response->redirect('/');
            }

            echo '<pre>';
            var_dump($client);
            echo '</pre>';
            exit;
            return $this->render('register', [
                'model' => $client
            ]);
        }

        return $this->render('register', [
            'model' => $client
        ]);
    }
}