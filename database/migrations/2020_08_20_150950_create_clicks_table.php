<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('ip');
            $table->string('referer')->nullable();
            $table->string('referer_host')->nullable();
            $table->text('user_agent')->nullable();
            $table->unsignedBigInteger('link_id');

            $table->index('ip');
            $table->index('referer_host');
            $table->index('link_id');
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');

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
        Schema::dropIfExists('clicks');
    }
}
