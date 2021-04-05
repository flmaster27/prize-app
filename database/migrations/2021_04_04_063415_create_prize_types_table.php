<?php

use App\Contracts\Entities\PrizeTypeContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrizeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prize_types', function (Blueprint $table) {
            $table->string(PrizeTypeContract::FIELD_TYPE)->primary();
            $table->integer(PrizeTypeContract::FIELD_COUNT);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prize_types');
    }
}
