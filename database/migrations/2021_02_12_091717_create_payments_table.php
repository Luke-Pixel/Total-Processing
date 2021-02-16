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
        //create payemnts table
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            //foriegn id to create relationship
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('refrence');
            $table->Integer('amount');
            $table->Integer('refunded');
            $table->text('payment_id');
            $table->timestamps();
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

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
