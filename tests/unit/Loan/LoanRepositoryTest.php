<?php

declare(strict_types=1);

namespace Test\unit\Loan;

use Loan\Entity\Loan;
use Loan\Builder\LoanBuilder;
use PHPUnit\Framework\TestCase;
use Loan\Repository\LoanRepository;
use Loan\Persistence\FilePersistence;


class LoanRepositoryTest extends TestCase
{
    private LoanRepository $repository;

    public function setUp():void
    {
        //$this->repository = new LoanRepository(new );
    }

    public function testCanSaveALoan(): void
    {
        $filePersistenceMock = $this->createMock(FilePersistence::class);

        //stub
        $filePersistenceMock->method('persist')->willReturn(true);
        // given
        $repository = new LoanRepository($filePersistenceMock);
        $data = ['name' => 'john doe', 'pin' => '8961', 'loan_amt' => 5000, 'period' => 7, 'purpose' => 'To repair my car.'];
        $loan = LoanBuilder::fromArray($data);

        // when
        $result = $repository->save($loan);

        // then
        $this->assertTrue($result);
    }

    public function testPersistCalledWhenCreatingALoan(): void
    {
        $filePersistenceMock = $this->createMock(FilePersistence::class);

        // stub
        $filePersistenceMock->method('persist')->willReturn(true);

        // spy
        //['name' => 'john doe', 'pin' => '8961', 'loan_amt' => '5000', 'period' => '7', 'purpose' => 'To repair my car.']
        $filePersistenceMock->expects($this->once())->method('persist')->with(new Loan('john doe', '8961', 5000, 7, 'To repair my car.'));

        // given
        $repository = new LoanRepository($filePersistenceMock);

        // when
        $data = ['name' => 'john doe', 'pin' => '8961', 'loan_amt' => 5000, 'period' => 7, 'purpose' => 'To repair my car.'];
        $loan = LoanBuilder::fromArray($data);
        $result = $repository->save($loan);

        // then
        $this->assertTrue($result);
    }
}