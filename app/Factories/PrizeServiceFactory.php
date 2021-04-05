<?php


namespace App\Factories;


use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\PrizeServiceContract;
use App\Contracts\PrizeServiceFactoryContract;
use App\Exceptions\PrizeTypeNotFoundException;

/**
 * Class PrizeServiceFactory
 * @package App\Factories
 */
class PrizeServiceFactory implements PrizeServiceFactoryContract
{
    /**
     * @param  string  $type
     * @return PrizeServiceContract
     * @throws PrizeTypeNotFoundException
     */
    public function getPrizeService(string $type): PrizeServiceContract
    {
        if(!in_array($type, array_keys(PrizeTypeContract::SERVICE_LIST))) {
            throw new PrizeTypeNotFoundException($type);
        }
        $class = PrizeTypeContract::SERVICE_LIST[$type];
        return resolve($class);
    }
}