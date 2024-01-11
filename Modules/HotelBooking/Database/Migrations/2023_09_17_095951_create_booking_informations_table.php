<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_type_id')->nullable()->constrained('room_types')->cascadeOnDelete();
            $table->integer('user_id')->nullable();
            $table->foreignId('hotel_id')->nullable()->constrained('hotels')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->references('id')->on('states')->onDelete('cascade');
            $table->string('reservation_id')->nullable();
            $table->string('email');
            $table->string('mobile');
            $table->text('street')->nullable();
            $table->text('state')->nullable();
            $table->string('post_code');
            $table->text('notes')->nullable();
            $table->date('booking_date');
            $table->date('booking_expiry_date');
            $table->boolean('booking_status')->default(1);
            $table->boolean('payment_status')->default(1);
            $table->string('payment_gateway')->nullable();
            $table->string('payment_track')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('order_details')->nullable();
            $table->string('payment_meta')->nullable();
            $table->integer('amount')->nullable();
            $table->string('payment_type')->nullable();
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
        Schema::dropIfExists('booking_informations');
    }
}
