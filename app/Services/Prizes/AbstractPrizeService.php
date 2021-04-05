<?php


namespace App\Services\Prizes;


use App\Contracts\Entities\PrizeContract;
use App\Contracts\Entities\UserPrizeContract;
use App\Contracts\PrizeServiceContract;
use App\Models\User;
use App\Models\UserPrize;
use App\Repositories\PrizeRepository;
use App\Repositories\PrizeTypeRepository;
use App\Repositories\UserPrizeRepository;

/**
 * Class AbstractPrizeService
 * @package App\Services\Prizes
 */
abstract class AbstractPrizeService implements PrizeServiceContract
{
    const TYPE = null;

    protected $prizeRepository;
    protected $prizeTypeRepository;
    protected $userPrizeRepository;

    /**
     * AbstractPrizeService constructor.
     * @param  PrizeRepository  $prizeRepository
     * @param  PrizeTypeRepository  $prizeTypeRepository
     * @param  UserPrizeRepository  $userPrizeRepository
     */
    public function __construct(
        PrizeRepository $prizeRepository,
        PrizeTypeRepository $prizeTypeRepository,
        UserPrizeRepository $userPrizeRepository
    ) {
        $this->prizeRepository = $prizeRepository;
        $this->prizeTypeRepository = $prizeTypeRepository;
        $this->userPrizeRepository = $userPrizeRepository;
    }

    /**
     * @param  User  $user
     * @return array
     */
    public function addTo(User $user): array
    {
        $prize = $this
            ->prizeRepository
            ->getFreePrizeByTypeLocked(static::TYPE);

        $this
            ->prizeRepository
            ->update($prize[PrizeContract::FIELD_ID], [PrizeContract::FIELD_IS_GIVEN => true]);

        $this->prizeTypeRepository->decrement(static::TYPE);

        return $this->userPrizeRepository->add([
            UserPrizeContract::FIELD_USER_ID => $user->id,
            UserPrizeContract::FIELD_PRIZE_ID => $prize[PrizeContract::FIELD_ID],
            UserPrizeContract::FIELD_AMOUNT => $prize[PrizeContract::FIELD_AMOUNT],
            UserPrizeContract::FIELD_TYPE => static::TYPE,
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

        $this
            ->prizeRepository
            ->update($userPrize->{UserPrizeContract::FIELD_PRIZE_ID}, [PrizeContract::FIELD_IS_GIVEN => false]);

        $this->prizeTypeRepository->increment(static::TYPE);
    }
}