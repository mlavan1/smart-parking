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
            $table-> unsignedBigInteger('location_id')->nullable();

            $table->string('name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('address');
            $table->decimal('hourly_rate',6,1);
            $table->integer('total_slots')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
