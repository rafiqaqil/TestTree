<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id'); // OWNER OF REQUEST
            $table->decimal('AMOUNT', 8, 2);
            $table->string('STATUS')->default('NEW'); // 0 NEW -1 CANCEL 1 APPROVED
            $table->string('WAY'); // IN OR OUT
            
            $table->string('DETAIL'); // IN OR OUT
            $table->integer('INFO_INT')->default(-1);// IN OR OUT
             $table->string('INFO_STR')->default('NONE');// IN OR OUT
            
            
            
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
        Schema::dropIfExists('payments');
    }
}
