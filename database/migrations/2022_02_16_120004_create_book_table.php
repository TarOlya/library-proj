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
        if (!Schema::hasTable('book')) {
            Schema::create('book', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('author_id');
                $table->unsignedBigInteger('genre_id');
                $table->timestamps();

                $table->foreign('author_id')->references('id')->on('author')->onUpdate('cascade')->onDelete('cascade');

                $table->foreign('genre_id')->references('id')->on('genre')->onUpdate('cascade')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
};
