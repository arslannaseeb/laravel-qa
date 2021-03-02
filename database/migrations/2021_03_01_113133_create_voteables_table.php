<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voteables', function (Blueprint $table) {
            $table->unSignedInteger('user_id');
            $table->unSignedInteger('voteable_id');
            $table->string('voteable_type');
            $table->tinyInteger('vote');
            $table->timestamps();
            $table->unique(['user_id','voteable_id','voteable_type']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voteables');
    }
}
