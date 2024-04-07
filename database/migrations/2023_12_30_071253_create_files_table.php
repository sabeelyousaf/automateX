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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('hv_code')->nullable();
            $table->string('form_no')->unique();
            $table->string('id_no');
            $table->string('security_no');
            $table->string('file_status');
            $table->string('type');
            $table->string('size');
            $table->string('unit');
            $table->bigInteger('total_amount');
            $table->bigInteger('paid_amount')->nullable();
            $table->string('balance_amount')->nullable();
            $table->text('file_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
