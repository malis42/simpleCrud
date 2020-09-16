<?php
namespace app\core;

use app\core\Response;
use app\core\Request;

class Router
{
    protected array $routes = [];
    protected array $params = [];
    public Request $request;
    public Response $response;

    /**
     * Router constructor.
     * @param \app\core\Request $request
     * @param \app\core\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        if($path !== '/' && substr($path, -1) === '/'){
            $path = rtrim($path, '/');
        }

        if(sizeof($complexPath = explode('/', $path)) > 2){
            if(is_numeric($complexPath[2])){
                $path = "/" . $complexPath[1] . "/id";
                $this->params[] = $complexPath[2];
                $callback = $this->routes[$method][$path] ?? false;
            }
        } else {
            $callback = $this->routes[$method][$path] ?? false;
        }

        if($callback === false){
            Application::$app->response->setStatusCode(404);

            return $this->renderView('_404');
        }


        if(is_string($callback)){
            return $this->renderView($callback);
        }

        if(is_array($callback)){
            // Create controller based on sting passed as callback[0]
            Application::$app->setController(new $callback[0]());

            // Assign the newly created controller instance back to callback[0]
            $callback[0] = Application::$app->getController();
        }


        if(!empty($this->params)) $callback[0]->params = $this->params;

        return call_user_func($callback, $this->request);
    }

    public function renderView($view, array $params = [])
    {
        $layoutContent = $this->createLayout();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function createLayout()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, array $params)
    {
        foreach ($params as $key => $value){
           $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/{$view}.php";
        return ob_get_clean();
    }
}