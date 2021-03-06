<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostjobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postjob', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('term');
            $table->string('title');
            $table->string('requirement');
            $table->string('image');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postjob');
    }
}
