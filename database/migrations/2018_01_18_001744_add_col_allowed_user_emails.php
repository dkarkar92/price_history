<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColAllowedUserEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::table('allowed_user_emails', function (Blueprint $table) {
            $table->unsignedInteger('default_store_id')->nullable()->after('email');
            $table->foreign('default_store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allowed_user_emails', function (Blueprint $table) {
            $table->dropColumn('default_store_id');
            $table->dropForeign('allowed_user_emails_default_store_id_foreign');
        });
    }
}
