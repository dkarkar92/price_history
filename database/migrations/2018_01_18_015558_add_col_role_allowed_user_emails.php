<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColRoleAllowedUserEmails extends Migration
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
            $table->unsignedInteger('role_id')->nullable()->after('email');
            $table->foreign('role_id')->references('id')->on('roles');
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
            $table->dropColumn('role_id');
            $table->dropForeign('allowed_user_emails_role_id_foreign');
        });
    }
}
