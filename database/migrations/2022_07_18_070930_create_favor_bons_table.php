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
        Schema::create('favor_bons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();            
            $table->string('title');
            $table->string('description');
            $table->string('qualified_description');
            $table->string('price');
            $table->string('price_description');
            $table->string('stock');
            $table->string('image')->nullable();

            $table->timestamps();

            $table->foreign('subcategory_id')->references('id')->on('subcategories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favor_bons');
    }
};
