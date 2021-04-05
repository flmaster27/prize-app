<?php


namespace App\Repositories;

/**
 * Interface PrizeTypeRepository
 * @package App\Repositories
 */
interface PrizeRepository
{
    /**
     * @param  string  $type
     * @return array
     */
    public function getFreePrizeByTypeLocked(string $type): array;

    /**
     * @param  int  $id
     * @param  array  $data
     */
    public function update(int $id, array $data);
}
