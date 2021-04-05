<?php


namespace App\Repositories;

/**
 * Interface PrizeTypeRepository
 * @package App\Repositories
 */
interface PrizeTypeRepository
{
    /**
     * @return array
     */
    public function getPrizeTypeRandomLocked(): array;

    /**
     * @param  string  $type
     */
    public function increment(string $type);

    /**
     * @param  string  $type
     */
    public function decrement(string $type);
}
