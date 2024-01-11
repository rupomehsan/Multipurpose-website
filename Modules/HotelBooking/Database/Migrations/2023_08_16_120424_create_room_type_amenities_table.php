<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('room_type_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("room_type_id");
            $table->unsignedBigInteger("amenity_id");
            $table->foreign("room_type_id")->references("id")->on("room_types")->cascadeOnDelete();
            $table->foreign("amenity_id")->references("id")->on("amenities")->cascadeOnDelete();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_amenities');
    }
};
