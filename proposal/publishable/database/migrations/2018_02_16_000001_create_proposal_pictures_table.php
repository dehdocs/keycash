<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',250);
            $table->string('title',100)->nulllable();
            $table->integer('proposal_id')->unsigned();
            $table->foreign('proposal_id')->references('id')->on('proposals');
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
        Schema::dropIfExists('proposal_pictures');
    }
}
