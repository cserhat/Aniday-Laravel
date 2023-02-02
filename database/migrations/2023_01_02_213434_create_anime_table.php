<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id("genres_id");
            $table->string("genres_type");
            $table->timestamps();
        });

        Schema::create('anime', function (Blueprint $table) {
            $table->id("anime_id");
            $table->string("anime_title");
            $table->string("slug");
            $table->string("anime_image");
            $table->text("anime_description");
            $table->enum("anime_type", array('Tv','Ova','Film'));
            $table->unsignedBigInteger('anime_genres');
            $table->foreign('anime_genres')->references('genres_id')->on('genres')->onDelete('cascade');
            $table->string("anime_duration");
            $table->date("anime_aired");
            $table->string("anime_score");
            $table->timestamps();
        });

        Schema::create('episode', function (Blueprint $table)
        {
            $table->id("episode_id");
            $table->string("episode_title");
            $table->unsignedBigInteger('id_anime');
            $table->foreign('id_anime')->references('anime_id')->on('anime')->onDelete('cascade');
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
        Schema::dropIfExists('genres');
        Schema::dropIfExists('anime');
        Schema::dropIfExists('episode');
    }
};
