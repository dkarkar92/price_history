<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToStores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::table('stores', function (Blueprint $table) {
            $table->string('city')->after('address_2');
            $table->string('phone_1')->after('postal_code');
            $table->string('phone_2')->after('postal_code');
            $table->string('fax_1')->after('postal_code');
            $table->string('address_2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('phone_1');
            $table->dropColumn('phone_2');
            $table->dropColumn('fax_1');
        });
    }
}
