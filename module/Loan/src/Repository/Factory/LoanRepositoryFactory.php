<?php 

namespace Loan\Repository\Factory;

use Loan\Persistence\Factory\FilePersistenceFactory;
use Loan\Repository\LoanRepository;
use Loan\Repository\LoanRepositoryInterface;

class LoanRepositoryFactory
{
    public static function create(): LoanRepositoryInterface
    {
        $persistence = FilePersistenceFactory::create();
        return new LoanRepository($persistence);
    }
}