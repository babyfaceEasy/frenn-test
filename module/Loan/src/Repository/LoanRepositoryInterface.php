<?php

namespace Loan\Repository;

use Loan\Entity\Loan;

interface LoanRepositoryInterface
{
    public function save(Loan $loan): bool;
}