<?php

namespace App\Services;

use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\Entities\UserPrizeContract;
use App\Contracts\PrizeServiceFactoryContract;
use App\Models\User;
use App\Models\UserPrize;
use App\Repositories\PrizeRepository;
use App\Repositories\PrizeTypeRepository;
use App\Repositories\UserPrizeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class UserPrizeService
 * @package App\Services
 */
class UserPrizeService
{
    protected $prizeRepository;
    protected $prizeTypeRepository;
    protected $userPrizeRepository;
    protected $prizeServiceFactory;

    /**
     * UserPrizeService constructor.
     * @param  PrizeRepository  $prizeRepository
     * @param  PrizeTypeRepository  $prizeTypeRepository
     * @param  UserPrizeRepository  $userPrizeRepository
     * @param  PrizeServiceFactoryContract  $prizeServiceFactory
     */
    public function __construct(
        PrizeRepository $prizeRepository,
        PrizeTypeRepository $prizeTypeRepository,
        UserPrizeRepository $userPrizeRepository,
        PrizeServiceFactoryContract $prizeServiceFactory
    ) {
        $this->prizeRepository = $prizeRepository;
        $this->prizeTypeRepository = $prizeTypeRepository;
        $this->userPrizeRepository = $userPrizeRepository;
        $this->prizeServiceFactory = $prizeServiceFactory;
    }

    /**
     * @param  User  $user
     * @return array
     */
    public function allByUser(User $user): array
    {
        return $this->userPrizeRepository->allByUser($user->id);
    }

    /**
     * @param  User  $user
     * @return array
     * @throws \Throwable
     */
    public function addRandomPrize(User $user): array
    {
        try {
            DB::beginTransaction();
            $selectedPrizeType = $this->prizeTypeRepository->getPrizeTypeRandomLocked();
            $userPrize = $this
                ->prizeServiceFactory
                ->getPrizeService($selectedPrizeType[PrizeTypeContract::FIELD_TYPE])
                ->addTo($user)
            ;
            DB::commit();

            return $userPrize;
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error($exception);
            throw $exception;
        }
    }

    /**
     * @param  UserPrize  $userPrize
     */
    public function delete(UserPrize $userPrize) {
        $this
            ->prizeServiceFactory
            ->getPrizeService($userPrize->{UserPrizeContract::FIELD_TYPE})
            ->removeFrom($userPrize)
        ;
    }

    /**
     * @param  UserPrize  $userPrize
     */
    public function deliver(UserPrize $userPrize) {
        $this
            ->prizeServiceFactory
            ->getPrizeService($userPrize->{UserPrizeContract::FIELD_TYPE})
            ->deliver($userPrize)
        ;
    }

    /**
     * @param  UserPrize  $userPrize
     */
    public function convert(UserPrize $userPrize) {
        $this
            ->prizeServiceFactory
            ->getPrizeService($userPrize->{UserPrizeContract::FIELD_TYPE})
            ->convert($userPrize)
        ;
    }
}
