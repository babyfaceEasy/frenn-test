<?php

declare(strict_types=1);

namespace Loan\Builder;

use Loan\Entity\Loan;

/**
 * Class LoanBuilder
 * 
 * @package Loan\Builder
 */
class LoanBuilder
{
    public static function fromArray(array $data): Loan
    {
        return new Loan($data['name'], $data['pin'], floatval($data['loan_amt']), intval($data['period']), $data['purpose']);
    }
}