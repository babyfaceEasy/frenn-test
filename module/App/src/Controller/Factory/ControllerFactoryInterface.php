<?php

namespace App\Controller\Factory;

use App\Controller\ControllerInterface;

interface ControllerFactoryInterface
{
    /**
     * @return ControllerInterface
     */
    public function create(): ControllerInterface;
} 