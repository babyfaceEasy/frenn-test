<?php

use App\Controller\Factory\LoanControllerFactory;
use App\Controller\IndexController;
use App\Controller\LoanController;

return [
    'controllers' => [
        'invokables' => [
            IndexController::class,
        ],
        'factories' => [
            LoanController::class => LoanControllerFactory::class
        ]
    ]
];