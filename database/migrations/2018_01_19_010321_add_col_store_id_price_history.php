<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColStoreIdPriceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('price_history', function (Blueprint $table) {
            $table->unsignedInteger('store_id')->nullable()->after('id');
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('price_history', function (Blueprint $table) {
            $table->dropColumn('store_id');
            $table->dropForeign('price_history_store_id_foreign');
        });
    }
}
