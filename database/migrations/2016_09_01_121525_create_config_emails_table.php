<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->bigInteger('conta');
            $table->string('tipo');
            $table->string('periodo');
            $table->string('grafico');
            $table->longText('texto');
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
        Schema::drop('config_emails');
    }
}


