<?php

namespace App\Models;

use App\Contracts\Entities\PrizeContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        PrizeContract::FIELD_TYPE,
        PrizeContract::FIELD_AMOUNT,
        PrizeContract::FIELD_IS_GIVEN,
    ];
}
