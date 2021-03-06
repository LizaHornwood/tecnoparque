<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetEventoPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_evento_personas', function (Blueprint $table) {
            
            //primary key
            $table->increments('idDetEventoPersona');

            //normal values
            $table->boolean('responsable')->nullable();

            //foreign key
            $table->integer('idEvento')->unsigned();
            $table->foreign('idEvento')->references('idEvento')->on('eventos')->onDelete('cascade');

            $table->integer('idPersona')->unsigned();
            $table->foreign('idPersona')->references('idPersona')->on('personas')->onDelete('cascade');

            //others
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
        Schema::drop('det_evento_personas');
    }
}
