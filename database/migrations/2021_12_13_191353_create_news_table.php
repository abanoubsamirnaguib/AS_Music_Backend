<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('News', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subTitle');
            $table->enum('category',["Video","Music","Life","Social"])->default('Music');
            $table->string('description');
            $table->integer('likesNumber');
            $table->integer('shareNumber');
            $table->dateTime('Date')->default(\Carbon\Carbon::now() );
            $table->longText('shareLink');
            $table->string('image')->default('default.png');
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
        Schema::dropIfExists('news');
    }
}
