<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Create table author
        Schema::create('author', function (Blueprint $table) {
            $table->bigIncrements('author_ID');
            $table->string('firstname')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->timestamps();
        });
        
        Schema::table('blogs', function(Blueprint $table){
            //Create new column
            $table->unsignedBigInteger('author_ID')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author');
    }
};
