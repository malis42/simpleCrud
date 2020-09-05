<?php

namespace app\controllers\interfaces;

use app\core\Request;

interface crudControllerInterface{
    public function index();

    public function store(Request $request);

    public function update(Request $request);

    public function delete(Request $request);
}