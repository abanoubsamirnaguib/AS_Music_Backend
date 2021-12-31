<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyMsgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_msg', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_me_id');
            $table->foreign('contact_me_id')->references('id')->on('contact_mes')->onDelete('cascade');
            $table->string('title');
            $table->longText('Message');
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
        Schema::dropIfExists('reply_msg');
    }
}
