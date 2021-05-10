<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->enum('category',['Fruits','Veggies','Meat & Seafood','Canned Food', 'Dairy & Eggs','Grains & Pasta','Frozen Food','Bread and Bakery','Miscellaneous']);
            $table->enum('measurement',['units','gr','ml','Tablespoons','Teaspoons']);
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
        Schema::dropIfExists('ingredients');
    }
}
