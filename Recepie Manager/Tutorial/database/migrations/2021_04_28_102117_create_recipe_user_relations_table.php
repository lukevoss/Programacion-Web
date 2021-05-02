<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeUserRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_user_relations', function (Blueprint $table) {
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('recipe');
            $table->boolean('cooked');
            $table->boolean('fav');
            $table->boolean('shopping');
            $table->unsignedTinyInteger('rating');
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
        Schema::dropIfExists('recipe_user_relations');
    }
}
