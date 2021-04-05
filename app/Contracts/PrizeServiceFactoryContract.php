<?php


namespace App\Contracts;


/**
 * Interface PrizeServiceFactoryContract
 * @package App\Contracts
 */
interface PrizeServiceFactoryContract
{
    /**
     * @param  string  $type
     * @return PrizeServiceContract
     */
    public function getPrizeService(string $type): PrizeServiceContract;
}