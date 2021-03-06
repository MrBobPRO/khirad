<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('latin_name'); //used in ROUTE URL
            $table->boolean('free')->default(true); 
            $table->float('price')->nullable();
            $table->text('description');
            $table->text('language');
            $table->string('filename');
            $table->string('photo');
            $table->string('screenshot1')->nullable();
            $table->string('screenshot2')->nullable();
            $table->string('screenshot3')->nullable();
            $table->string('publisher');    
            $table->integer('year');
            $table->integer('pages');
            $table->boolean('most_readable')->default(false);
            $table->string('txtColor')->nullable();
            $table->string('bgColor')->nullable();
            $table->string('btnColor')->nullable();
            $table->integer('number_of_readings')->default(0);
            $table->integer('marksCount')->default(0); 
            $table->float('averageMark')->default(0); //total average marks
            $table->string('marksTemplate')->default('0'); //(Laravel Blade) Marks Template
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
        Schema::dropIfExists('books');
    }
}
