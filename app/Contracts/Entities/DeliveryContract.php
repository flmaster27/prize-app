<?php


namespace App\Contracts\Entities;

/**
 * Interface DeliveryContract
 * @package App\Contracts\Entities
 */
interface DeliveryContract
{
    const TYPE_POST  = 'post';
    const TYPE_BANK  = 'bank';
    const TYPE_BONUS = 'bonus';
}
