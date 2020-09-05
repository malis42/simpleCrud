<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\controllers\interfaces\crudControllerInterface;
use app\core\Request;
use app\models\User;


class UserController extends Controller
{
    public function index()
    {
        $user = new User();

        if(!empty($this->params)){
            $data = $user->selectUser($this->params[0]);
        } else {
            $data = $user->selectAllUsers();
        }

        return $this->render('userIndex', [
            'data' => $data,
            'model' => $user
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();

        if($request->isPost()){
            $user->loadData($request->getBody());


            if($user->validate() && $user->save()){
                Application::$app->session->setFlash('success', 'User created successfully!');
                Application::$app->response->redirect('/user');
            }

            return $this->render('userCreate', [
                'model' => $user
            ]);
        }

        return $this->render('userCreate', [
            'model' => $user
        ]);
    }


    public function update(Request $request)
    {
        $user = new User();

        $data = $user->selectUser($this->params[0]);

        $userId = $data['id'];

        if($request->isPost()){
            $user->loadData($request->getBody());

            if($user->validate() && $user->update($userId)){
                Application::$app->session->setFlash('success', 'User edited successfully!');
                Application::$app->response->redirect('/user');
            }

            return $this->render('user');

        } else if ($request->isGet()){

            $user->loadData($data);

            return $this->render('userEdit', [
                'model' => $user,
                'record' => $data
            ]);
        }
    }

    public function delete(Request $request)
    {
        $user = new User();

        $data = $user->selectUser($this->params[0]);

        $userId = $data['id'];

        if($request->isPost()){
            if($user->delete($userId)){
                Application::$app->session->setFlash('success', 'User deleted successfully!');
                Application::$app->response->redirect('/user');
            }
        }
    }
}