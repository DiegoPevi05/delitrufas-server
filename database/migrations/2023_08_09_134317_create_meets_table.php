<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('specialist_id')->nullable(false);
            $table->foreign('specialist_id')->references('id')->on('specialists');
            $table->unsignedBigInteger('service_id')->nullable(false);
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedBigInteger('discount_code_id')->nullable(false);
            $table->foreign('discount_code_id')->references('id')->on('discount_codes');
            $table->date('date_meet')->nullable(false);
            $table->float('price')->nullable();
            $table->float('discount')->nullable();
            $table->float('discounted_price')->nullable();
            $table->boolean('canceled')->nullable();
            $table->text('canceled_reason')->nullable();
            $table->text('link_meet')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('survey_status')->nullable();
            $table->float('rate')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('meets');
    }
};
