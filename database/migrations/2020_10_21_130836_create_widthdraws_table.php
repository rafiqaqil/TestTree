<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidthdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *php artisan make:model widthdraw -mcr
     * @return void
     */
    public function up()
    {
        Schema::create('widthdraws', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Type');
            $table->string('STATUS')->default('0');
            $table->foreignId('user_id');
            $table->decimal('AMOUNT', 8, 2);
            $table->string('Name')->default('0');
            $table->string('Phone')->default('0');
            $table->string('USDT')->default('0');
            $table->string('Merch')->default('0');
            
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
        Schema::dropIfExists('widthdraws');
    }
}
