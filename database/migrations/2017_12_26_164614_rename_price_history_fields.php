<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePriceHistoryFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::table('price_history', function (Blueprint $table) {
            $table->renameColumn('price_1', 'cash');
            $table->renameColumn('price_2', 'credit_card');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::defaultStringLength(191);
        Schema::table('price_history', function (Blueprint $table) {
            $table->renameColumn('cash', 'price_1');
            $table->renameColumn('credit_card', 'price_2');
        });
    }
}
