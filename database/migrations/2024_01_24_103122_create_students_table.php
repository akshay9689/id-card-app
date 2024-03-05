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
            $table->integer('school_id');
            $table->integer('admin_id');
            $table->string('admission_no');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('dob');
            $table->string('blood_group');
            $table->string('father_name');
            $table->string('father_mobile');
            $table->string('mother_name');
            $table->string('mother_mobile');
            $table->string('photo');
            $table->timestamps();

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
