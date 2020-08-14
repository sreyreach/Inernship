<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile')->after('id')->nullable();
            $table->string('first_name')->after('profile')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('phone_number')->unique()->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColum('email');
            $table->dropColumn('phone_number');
        });
    }
}
