<?php

namespace App\Controller\Factory;

use App\Controller\LoanController;
use App\Controller\ControllerInterface;
use Loan\Service\Factory\LoanServiceFactory;

class LoanControllerFactory implements ControllerFactoryInterface 
{
    public function create(): ControllerInterface
    {
        $service = LoanServiceFactory::create();
        return new LoanController($service);
    }
}