<?php

declare(strict_types=1);

namespace Loan\Service;

use Loan\Entity\Loan;
use Loan\Repository\LoanRepositoryInterface;


/**
 * Class LoanService
 * 
 * @package Loan\Service
 */
class LoanService
{
    private LoanRepositoryInterface $repository;

    public function __construct(LoanRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createLoan(Loan $loan)
    {
        try {
           $this->repository->save($loan);
        } catch (\Exception $e) {
            // Log exception using a logger
            return false;
        }
        return true;
    }
}