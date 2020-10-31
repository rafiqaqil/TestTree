<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
                      $table->id();
            $table->timestamps();
            $table->string('Type')->default('0');
            $table->string('STATUS')->default('0');
            $table->foreignId('user_id');
            $table->decimal('AMOUNT', 8, 2);
             $table->string('from_username')->default('0');
            $table->string('to_user_id')->default('0');
            $table->string('to_username')->default('0');
            
            $table->integer('RESERVE_INT1')->default(0);
            $table->decimal('RESERVE_DEC1', 8, 2)->default(0.0);
            $table->string('RESERVE_STR1')->default('UNDEFINED');
             
             $table->integer('RESERVE_INT2')->default(0);
             $table->decimal('RESERVE_DEC2', 8, 2)->default(0.0);
             $table->string('RESERVE_STR2')->default('UNDEFINED');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
