<?php

use App\Contracts\Entities\PrizeContract;
use App\Contracts\Entities\PrizeTypeContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'prizes',
            function (Blueprint $table) {
                $table->id(PrizeContract::FIELD_ID);
                $table->string(PrizeContract::FIELD_TYPE);
                $table->boolean(PrizeContract::FIELD_IS_GIVEN);
                $table->unsignedBigInteger(PrizeContract::FIELD_AMOUNT);

                $table
                    ->foreign(PrizeContract::FIELD_TYPE)
                    ->references(PrizeTypeContract::FIELD_TYPE)
                    ->on('prize_types')
                    ->restrictOnDelete()
                    ->cascadeOnUpdate();

                $table->index(
                    [
                        PrizeContract::FIELD_TYPE,
                        PrizeContract::FIELD_IS_GIVEN,
                    ]
                );
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
    }
}
