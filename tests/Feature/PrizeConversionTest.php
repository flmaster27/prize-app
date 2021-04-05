<?php

namespace Tests\Feature;

use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\Entities\UserPrizeContract;
use App\Models\User;
use App\Models\UserPrize;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrizeConversionTest extends TestCase
{
    use RefreshDatabase;

    public function test_money_to_bonus_conversion()
    {
        $this->seed();

        $amount = 1000;
        $user = User::factory()->create();

        $userPrize = UserPrize::query()->create([
            UserPrizeContract::FIELD_TYPE    => PrizeTypeContract::TYPE_MONEY,
            UserPrizeContract::FIELD_AMOUNT  => $amount,
            UserPrizeContract::FIELD_USER_ID => $user->id,
        ]);

        $this
            ->actingAs($user)
            ->get('/convert-prize/' . $userPrize->{UserPrizeContract::FIELD_ID})
        ;

        $userPrizeConverted = UserPrize::query()->find($userPrize->{UserPrizeContract::FIELD_ID});

        $this->assertEquals(
            PrizeTypeContract::TYPE_BONUS,
            $userPrizeConverted->{UserPrizeContract::FIELD_TYPE}
        );

        $this->assertEquals(
            $amount * config('prize.money_to_bonus_factor'),
            $userPrizeConverted->{UserPrizeContract::FIELD_AMOUNT}
        );
    }
}
