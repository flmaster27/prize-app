<?php


namespace App\Repositories\Eloquent;


use App\Contracts\Entities\PrizeTypeContract;
use App\Models\PrizeType;
use App\Repositories\PrizeTypeRepository;

/**
 * Class PrizeTypeRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class PrizeTypeRepositoryEloquent implements PrizeTypeRepository
{
    /**
     * @return array
     */
    public function getPrizeTypeRandomLocked(): array
    {
        return
            PrizeType
                ::query()
                ->where(PrizeTypeContract::FIELD_COUNT, '>', 0)
                ->orWhere(PrizeTypeContract::FIELD_COUNT, -1)
                ->inRandomOrder()
                ->lockForUpdate()
                ->first()
                ->toArray();
    }

    /**
     * @param  string  $type
     */
    public function increment(string $type)
    {
        PrizeType::query()
            ->where(PrizeTypeContract::FIELD_TYPE, $type)
            ->increment(PrizeTypeContract::FIELD_COUNT)
        ;
    }

    /**
     * @param  string  $type
     */
    public function decrement(string $type)
    {
        PrizeType::query()
            ->where(PrizeTypeContract::FIELD_TYPE, $type)
            ->decrement(PrizeTypeContract::FIELD_COUNT)
        ;
    }
}
