<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;
class CreateDM3treesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_m3trees', function (Blueprint $table) {
               $table->id();
            $table->timestamps();
            NestedSet::columns($table);
             //$table->string('name')->unique();
             $table->string('name');
             $table->foreignId('user_id');
             $table->decimal('balance', 8, 2);
             $table->longText('logs');
             
             $table->foreignId('DM5tree_id')->default(0);
             
             $table->integer('RE_ENTRY_TIMES')->default(0);;
             $table->decimal('RE_ENTRY_BALANCE', 8, 2)->default(0.0);
              $table->decimal('CASH_BALANCE', 8, 2)->default(0.0);
              $table->decimal('REDEEM_BALANCE', 8, 2)->default(0.0);
              
             $table->string('ENTRY_TYPE')->default('UNDEFINED');//DM5 GROWTH AUTO RE-ENTRY OR 1000USD AUTO IN 5
             $table->string('DM5_ID')->default('UNDEFINED');
             
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
        Schema::dropIfExists('d_m3trees');
    }
}
