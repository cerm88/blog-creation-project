<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            // campo de relación (llave foranea de usuario)
            $table->bigInteger('user_id')->unsigned();

            // Campos de la tabla post
            $table->string('title');
            $table->string('slug')->unique(); // Campo único para los slugs
            $table->text('body');
            $table->string('image')->nullable();
            $table->text('iframe')->nullable();

            // conexión en la relación entre tablas
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('posts');
    }
}
