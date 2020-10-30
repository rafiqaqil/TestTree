<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;
class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
             NestedSet::columns($table);
             $table->string('name')->unique();
             $table->foreignId('user_id');
             $table->decimal('balance', 8, 2);
             $table->longText('logs');
             
             $table->decimal('affiliate_type', 8, 2)->default(0.0); //200 , 
             
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
        Schema::dropIfExists('sponsors');
    }
}
