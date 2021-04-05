<?php


namespace App\Contracts;

use App\Models\User;
use App\Models\UserPrize;

/**
 * Interface PrizeServiceContract
 * @package App\Contracts
 */
interface PrizeServiceContract
{
    /**
     * @param  User  $user
     * @return array
     */
    public function addTo(User $user): array;

    /**
     * @param  UserPrize  $userPrize
     */
    public function removeFrom(UserPrize $userPrize);

    /**
     * @param  UserPrize  $userPrize
     */
    public function deliver(UserPrize $userPrize);

    /**
     * @param  UserPrize  $userPrize
     */
    public function convert(UserPrize $userPrize);
}