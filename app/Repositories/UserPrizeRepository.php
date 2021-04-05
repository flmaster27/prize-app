<?php


namespace App\Repositories;

/**
 * Interface UserPrizeRepository
 * @package App\Repositories
 */
interface UserPrizeRepository
{
    /**
     * @param  int  $userId
     * @return array
     */
    public function allByUser(int $userId): array;

    /**
     * @param  array  $data
     * @return array
     */
    public function add(array $data): array;

    /**
     * @param  int  $id
     * @param  array  $data
     */
    public function update(int $id, array $data);

    /**
     * @param  int  $id
     */
    public function remove(int $id);
}
