<?php

namespace Loan\Service\Factory;

use Loan\Service\LoanService;
use Loan\Repository\Factory\LoanRepositoryFactory;

class LoanServiceFactory
{
    public static function create(): LoanService
    {
        $repository = LoanRepositoryFactory::create();
        return new LoanService($repository);
    }
}