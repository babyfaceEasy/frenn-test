<?php

//07061736544

namespace App\Controller;

class IndexController extends Controller 
{
    public function indexAction()
    {
        $options = [];
        return $this->render(['options' => $options], 'homepage');
    }
}