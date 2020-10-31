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
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('national_id')->nullable();
            $table->string('country')->nullable();
            $table->string('merchantrade_acc')->nullable();
            $table->string('usdt_wallet')->nullable();
           
             $table->string('placement_payment_type')->default(0);
             $table->string('payment_type')->default(0);
            $table->string('membership_type')->default(0);
            $table->boolean('membership_paid')->default(0);
            
            $table->string('affiliate_type')->default(0);
            $table->boolean('affiliate_paid')->default(0);
             $table->string('affiliate_sponsor')->default(0);
            
            
            $table->string('S1')->nullable();
            $table->string('S2')->nullable();
            $table->string('S3')->nullable();
            $table->string('S4')->nullable();
            
             $table->decimal('D1', 8, 2)->nullable();
             $table->decimal('D2', 8, 2)->nullable();
             $table->decimal('D3', 8, 2)->nullable();
             $table->decimal('D4', 8, 2)->nullable(); 
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
