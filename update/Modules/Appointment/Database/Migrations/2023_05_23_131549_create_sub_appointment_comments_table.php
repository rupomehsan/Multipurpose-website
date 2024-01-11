<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubAppointmentCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_appointment_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_appointment_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_id');
            $table->string('commented_by');
            $table->longText('comment_content');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('sub_appointment_comments');
    }
}
