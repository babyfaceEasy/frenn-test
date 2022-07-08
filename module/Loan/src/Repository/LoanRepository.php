<?php

declare(strict_types=1);

namespace Loan\Repository;

use Loan\Entity\Loan;
use Loan\Persistence\LoanPersistenceInterface;

class LoanRepository implements LoanRepositoryInterface
{
    private LoanPersistenceInterface $persistence;

    public function __construct(LoanPersistenceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    public function save(Loan $loan): bool
    {
        if(!$this->persistence->persist($loan)) {
            return false;
        }
        return true;
        #return false;
    }
}