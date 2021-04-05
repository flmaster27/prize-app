<?php


namespace App\Services\Prizes;


use App\Contracts\Entities\DeliveryContract;
use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\Entities\UserPrizeContract;
use App\Contracts\PrizeServiceContract;
use App\Exceptions\ConversionNotAllowedException;
use App\Models\UserPrize;

/**
 * Class ItemPrizeService
 * @package App\Services\Prizes
 */
class ItemPrizeService extends AbstractPrizeService implements PrizeServiceContract
{
    const TYPE = PrizeTypeContract::TYPE_ITEM;

    /**
     * @param  UserPrize  $userPrize
     */
    public function deliver(UserPrize $userPrize)
    {
        $this->userPrizeRepository->update(
            $userPrize->{UserPrizeContract::FIELD_ID},
            [UserPrizeContract::FIELD_DELIVERED => DeliveryContract::TYPE_POST]
        );

        //Post service API
    }

    /**
     * @param  UserPrize  $userPrize
     * @throws ConversionNotAllowedException
     */
    public function convert(UserPrize $userPrize)
    {
        throw new ConversionNotAllowedException();
    }
}