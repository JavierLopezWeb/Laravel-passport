<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('video');
            $table->text('vote_count');
            $table->text('popularity');
            $table->text('poster_path');
            $table->text('original_language');
            $table->text('original_title');
            $table->text('genre_ids');
            $table->text('backdrop_path');
            $table->text('overview');
            $table->text('release_date');
            $table->boolean('modified');
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
        Schema::dropIfExists('films');
    }
}
