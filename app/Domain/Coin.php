<?php

namespace App\Domain;

class Coin
{
    private string $coin_id;
    private string $symbol;
    private string $name;
    private float $value_usd;
    private float $amount;

    /**
     * @param string $coin_id
     * @param string $symbol
     * @param string $name
     * @param float $value_usd
     * @param float $amount
     */
    public function __construct(string $coin_id, string $symbol, string $name, float $value_usd, float $amount)
    {
        $this->coin_id = $coin_id;
        $this->symbol = $symbol;
        $this->name = $name;
        $this->value_usd = $value_usd;
        $this->amount = $amount;
    }


    public function getCoinId(): string
    {
        return $this->coin_id;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getValueUsd(): float
    {
        return $this->value_usd;
    }

    /**
     * @param float $value_usd
     */
    public function setValueUsd(float $value_usd): void
    {
        $this->value_usd = $value_usd;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
}
