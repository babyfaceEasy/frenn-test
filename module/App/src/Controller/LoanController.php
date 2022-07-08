<?php

declare(strict_types=1);

namespace App\Controller;

use Loan\Service\LoanService;
use App\Request\RequestInterface;
use Loan\Builder\LoanBuilder;

/**
 * 
 * Class LoanController
 * 
 * @package App\Controller
 */

class LoanController extends Controller
{
    public function __construct(private LoanService $service){}

    private function containsAtLeastOneWord(string $sentence, array $words, $caseSensitive = false): bool
    {
        if (false === $caseSensitive) $sentence = strtolower($sentence);
        foreach($words as $word){
            if (false === $caseSensitive) $word = strtolower($word);
            #if (strpos($sentence, $word) !== false) return true;
            if (str_contains($sentence, $word)) return true;
        }

        return false;
    }

    private function isPINValid(string $code): bool
    {
  
        $control = intval(substr($code,-1));
        #$retval  = false;
  
        $mod  = 0;
        $total = 0;
  
        /* Do first run. */
        for ($i=-1; $i < 9; $i++) {
            $total += intval($code[$i]) * ((($i+1)%9)+1);
        }
        $mod = $total % 11;
  
        /* If modulus is ten we need second run. */
        $total = 0;
        if ($mod == 10) {
          for ($i=1; $i < 11; $i++) {
            $total += intval($code[$i]) * ((($i+1)%9)+1);
          }
          $mod = $total % 11;
  
          /* If modulus is still ten revert to 0. */
          if (10 == $mod) {
            $mod = 0;
          }
        }
        return $control == $mod;
    }

    /**
     * @return mixed
     */
    private function validateRequest(RequestInterface $request)
    {
        $error_msgs = [];
        $validationPassed = true;

        if(empty($request->input('name'))) {
            $validationPassed = false;
            $error_msgs['name'] = 'Name is required.';
            return [$validationPassed, $error_msgs];
        }

        if(empty($request->input('pin'))) {
            $validationPassed = false;
            $error_msgs['pin'] = 'PIN is required.';
            return [$validationPassed, $error_msgs];
        }

        if(empty($request->input('loan_amt'))) {
            $validationPassed = false;
            $error_msgs['loan_amt'] = 'Loan amount is required.';
            return [$validationPassed, $error_msgs];
        }

        if(empty($request->input('period'))) {
            $validationPassed = false;
            $error_msgs['period'] = 'Period is required.';
            return [$validationPassed, $error_msgs];
        }

        if(empty($request->input('purpose'))) {
            $validationPassed = false;
            $error_msgs['purpose'] = 'Purpose is required.';
            return [$validationPassed, $error_msgs];
        }

        $names = explode(' ', trim($request->input('name')));
        if(count($names) < 2) {
            $validationPassed = false;
            $error_msgs['name'] = 'Please provide both your first and last names.';
        }

        $pin = $request->input('pin');
        if(!$this->isPINValid($pin)) {
            $validationPassed = false;
            $error_msgs['pin'] = 'Please provide a vaild PIN.';
        }

        $loanAmt = $request->input('loan_amt');
        if (!($loanAmt >= 1000 && $loanAmt <=10000)) {
            $validationPassed = false;
            $error_msgs['loan_amt'] = 'Loan amount must be in between 1,000 and 10,000 .';
        }

        $period = $request->input('period');
        if(!($period >= 6 && $period <= 24)) {
            $validationPassed = false;
            $error_msgs['period'] = 'Period must be in between 6 and 24 months.';
        }

        $purpose = $request->input('purpose');
        $words = ['holiday', 'repair', 'consumer electronics', 'wedding', 'rental', 'car', 'school', 'investment'];
        if(!($this->containsAtLeastOneWord($purpose, $words))) {
            $validationPassed = false;
            $error_msgs['purpose'] = 'Purpose must consist at least one of these words: holiday, repair, consumer electronics, wedding, rental, car, school, investment.'; 
        }
        return [$validationPassed, $error_msgs];
    }

    public function indexAction(RequestInterface $request)
    {
        $options = [];
        list($valid, $error_msgs) = $this->validateRequest($request);
        if(false === $valid) {
            $options['error'] = 'Validation Error:';
            $options['validation_messages'] = $error_msgs;
            return $this->render(['options' => $options], 'homepage');
        }

        $loanEntity =  LoanBuilder::fromArray($request->all());

        try {
            $response = $this->service->createLoan($loanEntity);
        } catch (\Throwable $e) {
            // log error
            http_response_code(400);
            $options['error'] = 'An error occurred, please try again later.';
            return $this->render(['options' => $options], 'homepage');
        }

        if (false === $response) {
           $options['error'] = 'An error occurred, please try again later.';
           return $this->render(['options' => $options], 'homepage');
        }

        $options['success'] = 'Data added Successfully.';
        return $this->render(['options' => $options], 'homepage');
    }
}