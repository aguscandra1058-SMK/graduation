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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('nis')->unique();
            $table->integer('nisn')->unique();
            $table->string('name');
            $table->string('gender');
            $table->unsignedBigInteger('id_classroom');
            $table->unsignedBigInteger('id_major');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_classroom')->references('id')->on('classrooms');
            $table->foreign('id_major')->references('id')->on('majors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
