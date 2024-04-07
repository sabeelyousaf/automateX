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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->string('nationality');
            $table->string('email')->unique();
            $table->string('address');
            $table->bigInteger('phone_no');
            $table->date('date_of_birth');
            $table->string('cnic');
            $table->string('files')->nullable();
            $table->string('nominee')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
