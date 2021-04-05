<?php

namespace App\Models;

use App\Contracts\Entities\UserPrizeContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPrize extends Model
{
    use SoftDeletes;

    protected $fillable = [
        UserPrizeContract::FIELD_TYPE,
        UserPrizeContract::FIELD_AMOUNT,
        UserPrizeContract::FIELD_PRIZE_ID,
        UserPrizeContract::FIELD_USER_ID,
        UserPrizeContract::FIELD_DELIVERED,
    ];

    protected $dates = [
        UserPrizeContract::FIELD_CREATED_AT,
        UserPrizeContract::FIELD_UPDATED_AT,
        UserPrizeContract::FIELD_DELETED_AT,
    ];
}
