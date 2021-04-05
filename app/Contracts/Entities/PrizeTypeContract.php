<?php


namespace App\Contracts\Entities;

use App\Services\Prizes\BonusPrizeService;
use App\Services\Prizes\ItemPrizeService;
use App\Services\Prizes\MoneyPrizeService;

/**
 * Interface PrizeTypeContract
 * @package App\Contracts\Entities
 */
interface PrizeTypeContract
{
    const TYPE_MONEY = 'money';
    const TYPE_BONUS = 'bonus';
    const TYPE_ITEM  = 'item';

    const FIELD_TYPE  = 'type';
    const FIELD_COUNT = 'count';

    const LIST = [
        self::TYPE_MONEY,
        self::TYPE_BONUS,
        self::TYPE_ITEM,
    ];

    const SERVICE_LIST = [
        self::TYPE_MONEY => MoneyPrizeService::class,
        self::TYPE_BONUS => BonusPrizeService::class,
        self::TYPE_ITEM  => ItemPrizeService::class,
    ];
}
