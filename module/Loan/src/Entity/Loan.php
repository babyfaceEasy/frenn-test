<?php

declare(strict_types=1);

namespace Loan\Entity;


class Loan
{
    private string $name;
    private string $PIN;
    private float $amount;
    private int $period;
    private string $purpose;

    public function __construct(string $name, string $PIN, float $amount, int $period, string $purpose)
    {
        $this->name = $name;
        $this->PIN = $PIN;
        $this->amount = $amount;
        $this->period = $period;
        $this->purpose = $purpose;
        //return new self($name, $PIN, $amount, $period, $purpose);
    }   
    

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of PIN
     */ 
    public function getPIN()
    {
        return $this->PIN;
    }

    /**
     * Set the value of PIN
     *
     * @return  self
     */ 
    public function setPIN($PIN)
    {
        $this->PIN = $PIN;

        return $this;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of period
     */ 
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set the value of period
     *
     * @return  self
     */ 
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get the value of purpose
     */ 
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * Set the value of purpose
     *
     * @return  self
     */ 
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;

        return $this;
    }
}