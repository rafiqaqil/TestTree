<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;
class CreateDM5treesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_m5trees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            NestedSet::columns($table);
             $table->string('name');
             $table->foreignId('user_id');
             $table->decimal('balance', 8, 2);
             $table->longText('logs');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_m5trees');
    }
}
