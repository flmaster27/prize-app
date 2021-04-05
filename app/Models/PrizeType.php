<?php

namespace App\Models;

use App\Contracts\Entities\PrizeTypeContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrizeType extends Model
{
    use HasFactory;

    public $incrementing  = false;
    public $timestamps    = false;

    protected $primaryKey = PrizeTypeContract::FIELD_TYPE;
    protected $keyType    = 'string';

    protected $fillable = [
        PrizeTypeContract::FIELD_COUNT,
    ];
}
