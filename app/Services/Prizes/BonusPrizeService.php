<?php


namespace App\Services\Prizes;


use App\Contracts\Entities\DeliveryContract;
use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\Entities\UserPrizeContract;
use App\Contracts\PrizeServiceContract;
use App\Exceptions\ConversionNotAllowedException;
use App\Models\User;
use App\Models\UserPrize;

/**
 * Class BonusPrizeService
 * @package App\Services\Prizes
 */
class BonusPrizeService extends AbstractPrizeService implements PrizeServiceContract
{
    const TYPE = PrizeTypeContract::TYPE_BONUS;

    /**
     * @param  User  $user
     * @return array
     */
    public function addTo(User $user): array
    {
        return $this->userPrizeRepository->add([
            UserPrizeContract::FIELD_USER_ID => $user->id,
            UserPrizeContract::FIELD_AMOUNT => rand(
                config('prize.bonus.min'),
                config('prize.bonus.max'),
            ),
            UserPrizeContract::FIELD_TYPE => self::TYPE,
        ]);
    }

    /**
     * @param  UserPrize  $userPrize
     */
    public function removeFrom(UserPrize $userPrize)
    {
        $this
            ->userPrizeRepository
            ->remove($userPrize->{UserPrizeContract::FIELD_ID});
    }

    /**
     * @param  UserPrize  $userPrize
     */
    public function deliver(UserPrize $userPrize)
    {
        $this->userPrizeRepository->update(
            $userPrize->{UserPrizeContract::FIELD_ID},
            [UserPrizeContract::FIELD_DELIVERED => DeliveryContract::TYPE_BONUS]
        );

        //Add to bonus account
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