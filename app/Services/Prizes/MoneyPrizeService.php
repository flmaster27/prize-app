<?php


namespace App\Services\Prizes;


use App\Contracts\Entities\DeliveryContract;
use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\Entities\UserPrizeContract;
use App\Contracts\PrizeServiceContract;
use App\Models\UserPrize;

/**
 * Class MoneyPrizeService
 * @package App\Services\Prizes
 */
class MoneyPrizeService extends AbstractPrizeService implements PrizeServiceContract
{
    const TYPE = PrizeTypeContract::TYPE_MONEY;

    /**
     * @param  UserPrize  $userPrize
     */
    public function deliver(UserPrize $userPrize)
    {
        $this->userPrizeRepository->update(
            $userPrize->{UserPrizeContract::FIELD_ID},
            [UserPrizeContract::FIELD_DELIVERED => DeliveryContract::TYPE_BANK]
        );

        //Bank API
    }

    /**
     * @param  UserPrize  $userPrize
     */
    public function convert(UserPrize $userPrize)
    {
        $this->userPrizeRepository->update(
            $userPrize->{UserPrizeContract::FIELD_ID},
            [
                UserPrizeContract::FIELD_TYPE   => PrizeTypeContract::TYPE_BONUS,
                UserPrizeContract::FIELD_AMOUNT =>
                    config('prize.money_to_bonus_factor') * $userPrize->{UserPrizeContract::FIELD_AMOUNT},
            ]
        );
    }
}