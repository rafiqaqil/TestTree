<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id');
            $table->index('user_id');
            
            $table->string('name')->nullable();
            $table->string('D1')->nullable();
            $table->string('D2')->nullable();
            $table->string('D3')->nullable();
            $table->string('D4')->nullable();
            $table->string('D5')->nullable();
            $table->string('D6')->nullable();
            $table->string('D7')->nullable();


     
          
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
