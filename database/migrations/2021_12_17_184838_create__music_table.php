<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Music', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->string('Artist');
            $table->string('Label');
            // $table->enum('category',["Video","Music","Life","Social"])->default('Music');
            $table->longText('description')->nullable();
            $table->integer('likesNumber');
            $table->integer('shareNumber');
            $table->dateTime('Released')->default(\Carbon\Carbon::now() );
            $table->longText('shareLink');
            $table->string('image')->default('default.png');
            $table->string('track')->default('1.mp3');
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
        Schema::dropIfExists('_music');
    }
}
