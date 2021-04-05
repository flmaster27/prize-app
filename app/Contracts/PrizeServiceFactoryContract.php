<?php


namespace App\Contracts;


/**
 * Interface PrizeServiceFactoryContract
 * @package App\Contracts
 */
interface PrizeServiceFactoryContract
{
    public function getPrizeService(string $type): PrizeServiceContract;
}