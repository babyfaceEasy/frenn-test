<?php 

namespace Loan\Persistence;

use Loan\Entity\Loan;
use Loan\Exception\ReadJSONException;
use Loan\Exception\WriteJSONException;
use Loan\Exception\CreateJSONFileException;


/**
 * 
 * Class FilePersistence
 * 
 * @package Loan\Persistence
 */
class FilePersistence implements LoanPersistenceInterface
{
    private string $filename;

    public function __construct()
    {
        $this->filename = __DIR__ . '/../../../../data/loan.json';
        $this->initializeDB();
    }

    /**
     * 
     * @throws CreateJSONFileException
     */
    private function initializeDB(): void
    {
        if(!file_exists($this->filename)) {
            $fileHandler = fopen($this->filename, 'w+');
            if (!$fileHandler) {
                throw new CreateJSONFileException();
            }
            fclose($fileHandler);
        }
    }

    /**
     * 
     * @throws ReadJSONException
     * @throws WriteJSONException
     */
    public function persist(Loan $loan): bool
    {
        $currentData = file_get_contents($this->filename);
        if (false === $currentData) {
            throw new ReadJSONException();
        }
        $arrayData = json_decode($currentData, true);
        #$arrayData[] = $data;
        $arrayData[] = [
            'name' => $loan->getName(),
            'pin' => $loan->getPIN(),
            'loan_amt' => $loan->getAmount(),
            'period' => $loan->getPeriod(),
            'purpose' => $loan->getPurpose(),
        ];
        $finalData = json_encode($arrayData);
        $handle = file_put_contents($this->filename, $finalData);
        if (false === $handle) {
            throw new WriteJSONException();
        }

        return true;
    }
}