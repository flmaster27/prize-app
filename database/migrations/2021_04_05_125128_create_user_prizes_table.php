<?php

use App\Contracts\Entities\PrizeContract;
use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\Entities\UserPrizeContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user_prizes',
            function (Blueprint $table) {
                $table->id(UserPrizeContract::FIELD_ID);
                $table->string(UserPrizeContract::FIELD_TYPE);
                $table->unsignedBigInteger(UserPrizeContract::FIELD_USER_ID);
                $table->unsignedBigInteger(UserPrizeContract::FIELD_PRIZE_ID)->nullable();
                $table->unsignedBigInteger(UserPrizeContract::FIELD_AMOUNT);
                $table->string(UserPrizeContract::FIELD_DELIVERED)->nullable();
                $table->timestamp(UserPrizeContract::FIELD_CREATED_AT)->nullable();
                $table->timestamp(UserPrizeContract::FIELD_UPDATED_AT)->nullable();
                $table->softDeletes(UserPrizeContract::FIELD_DELETED_AT);

                $table
                    ->foreign(UserPrizeContract::FIELD_TYPE)
                    ->references(PrizeTypeContract::FIELD_TYPE)
                    ->on('prize_types')
                    ->restrictOnDelete()
                    ->cascadeOnUpdate();

                $table
                    ->foreign(UserPrizeContract::FIELD_PRIZE_ID)
                    ->references(PrizeContract::FIELD_ID)
                    ->on('prizes')
                    ->restrictOnDelete()
                    ->cascadeOnUpdate();

                $table
                    ->foreign(UserPrizeContract::FIELD_USER_ID)
                    ->references('id')
                    ->on('users')
                    ->restrictOnDelete()
                    ->cascadeOnUpdate();

                $table->index(
                    [
                        UserPrizeContract::FIELD_TYPE,
                        UserPrizeContract::FIELD_DELIVERED,
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
        Schema::dropIfExists('user_prizes');
    }
}
