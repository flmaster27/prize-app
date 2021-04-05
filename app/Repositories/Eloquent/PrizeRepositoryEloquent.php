<?php


namespace App\Repositories\Eloquent;


use App\Contracts\Entities\PrizeContract;
use App\Models\Prize;
use App\Repositories\PrizeRepository;

/**
 * Class PrizeTypeRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class PrizeRepositoryEloquent implements PrizeRepository
{
    /**
     * @param  string  $type
     * @return array
     */
    public function getFreePrizeByTypeLocked(string $type): array
    {
        return
            Prize
                ::query()
                ->where(PrizeContract::FIELD_TYPE, $type)
                ->where(PrizeContract::FIELD_IS_GIVEN, false)
                ->inRandomOrder()
                ->lockForUpdate()
                ->first()
                ->toArray();
    }

    /**
     * @param  int  $id
     * @param  array  $data
     */
    public function update(int $id, array $data)
    {
        Prize::query()
            ->where(PrizeContract::FIELD_ID, $id)
            ->update($data)
        ;
    }
}
