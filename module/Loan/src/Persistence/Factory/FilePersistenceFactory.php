<?php

namespace Loan\Persistence\Factory;

use Loan\Persistence\FilePersistence;
use Loan\Persistence\LoanPersistenceInterface;

class FilePersistenceFactory
{
    public static function create(): LoanPersistenceInterface
    {
        return new FilePersistence();
    }
}