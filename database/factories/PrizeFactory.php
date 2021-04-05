<?php

namespace Database\Factories;

use App\Contracts\Entities\PrizeContract;
use App\Contracts\Entities\PrizeTypeContract;
use App\Models\Prize;
use App\Models\PrizeType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prize::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type =
            $this
                ->faker
                ->randomElement([PrizeTypeContract::TYPE_MONEY, PrizeTypeContract::TYPE_ITEM]);
        PrizeType
            ::query()
            ->where(PrizeTypeContract::FIELD_TYPE, $type)
            ->increment(PrizeTypeContract::FIELD_COUNT);

        return [
            PrizeContract::FIELD_TYPE => $type,
            PrizeContract::FIELD_IS_GIVEN => false,
            PrizeContract::FIELD_AMOUNT => $type == PrizeTypeContract::TYPE_MONEY ? rand(100, 1000) : 1,
        ];
    }
}
