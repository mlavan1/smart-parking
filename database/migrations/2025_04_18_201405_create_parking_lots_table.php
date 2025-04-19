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
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->id();
            $table-> unsignedBigInteger('user_id')->nullable();
            $table-> unsignedBigInteger('vendor_id')->nullable();
            $table->string('name');
            $table-> unsignedBigInteger('location_id')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('address');
            $table->decimal('hourly_rate',5,1);
            $table->integer('total_slots');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_slots');
    }
};
