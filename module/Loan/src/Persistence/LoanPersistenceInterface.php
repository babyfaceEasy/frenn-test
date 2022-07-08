<?php

namespace Loan\Persistence;

use Loan\Entity\Loan;

interface LoanPersistenceInterface
{
    public function persist(Loan $loan): bool;
}