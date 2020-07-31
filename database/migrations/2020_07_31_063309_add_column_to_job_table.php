<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postjob', function (Blueprint $table) {
            $table->string('experience')->after('requirement')->nullable();
            $table->string('email')->after('experience')->nullable();
            $table->string('last_date')->after('email')->nullable();
            $table->string('address')->after('last_date')->nullable();
            $table->string('phone_number')->after('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postjob', function (Blueprint $table) {
            $table->dropColumn('experience');
            $table->dropColumn('email');
            $table->dropColumn('last_date');
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
        });
    }
}
