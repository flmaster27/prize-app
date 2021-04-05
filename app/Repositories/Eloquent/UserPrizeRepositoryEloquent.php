<?php


namespace App\Repositories\Eloquent;


use App\Contracts\Entities\UserPrizeContract;
use App\Models\UserPrize;
use App\Repositories\UserPrizeRepository;

/**
 * Class UserPrizeRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class UserPrizeRepositoryEloquent implements UserPrizeRepository
{
    /**
     * @param  int  $userId
     * @return array
     */
    public function allByUser(int $userId): array
    {
        return UserPrize
            ::query()
            ->where(UserPrizeContract::FIELD_USER_ID, $userId)
            ->orderByDesc(UserPrizeContract::FIELD_ID)
            ->get()
            ->toArray();
    }

    /**
     * @param $data
     * @return array
     */
    public function add(array $data): array
    {
        return UserPrize::query()->create($data)->toArray();
    }

    /**
     * @param  int  $id
     * @param  array  $data
     */
    public function update(int $id, array $data)
    {
        UserPrize::query()->where(UserPrizeContract::FIELD_ID, $id)->update($data);
    }

    /**
     * @param  int  $id
     */
    public function remove(int $id)
    {
        UserPrize::query()->where(UserPrizeContract::FIELD_ID, $id)->delete();
    }
}
