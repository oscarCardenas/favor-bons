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
        Schema::create('favorbonds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();            
            $table->string('title');
            $table->text('description')->nullable();;
            $table->text('qualified_description')->nullable();;
            $table->string('price');
            $table->text('price_description')->nullable();;
            $table->integer('execution_of_favor_id');
            $table->integer('unlimited')->nullable();
            $table->integer('stock')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('subcategory_id')->references('id')->on('subcategories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('execution_of_favor_id')->references('id')->on('execution_of_favor')
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
        Schema::dropIfExists('favorbonds');
    }
};
