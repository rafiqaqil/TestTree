<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sponsors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_anak_baru');
            $table->string('nama_sponsor');
            $table->string('desc');
             $table->foreignId('sponsor_id');
             $table->decimal('amount', 8, 2);
            
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_sponsors');
    }
}
