<?php

namespace Database\Seeders;

use App\Contracts\Entities\PrizeTypeContract;
use App\Models\Prize;
use App\Models\PrizeType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        PrizeType::query()->insert([
            [
                PrizeTypeContract::FIELD_TYPE  => PrizeTypeContract::TYPE_MONEY,
                PrizeTypeContract::FIELD_COUNT => 0,
            ],
            [
                PrizeTypeContract::FIELD_TYPE  => PrizeTypeContract::TYPE_ITEM,
                PrizeTypeContract::FIELD_COUNT => 0,
            ],
            [
                PrizeTypeContract::FIELD_TYPE  => PrizeTypeContract::TYPE_BONUS,
                PrizeTypeContract::FIELD_COUNT => -1,
            ],
        ]);

        Prize::factory(1000)->create();
    }
}
