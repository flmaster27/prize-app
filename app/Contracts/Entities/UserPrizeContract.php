<?php


namespace App\Contracts\Entities;

/**
 * Interface PrizeContract
 * @package App\Contracts\Entities
 */
interface UserPrizeContract
{
    const FIELD_ID         = 'id';
    const FIELD_TYPE       = 'type';
    const FIELD_USER_ID    = 'user_id';
    const FIELD_PRIZE_ID   = 'prize_id';
    const FIELD_AMOUNT     = 'amount';
    const FIELD_DELIVERED  = 'delivered';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_UPDATED_AT = 'updated_at';
    const FIELD_DELETED_AT = 'deleted_at';
}
