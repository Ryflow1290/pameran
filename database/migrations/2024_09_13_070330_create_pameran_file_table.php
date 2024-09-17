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
        Schema::create('pameran_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pameran_id'); // Reference to the pameran
            $table->string('path'); // File path
            $table->string('caption')->nullable(); // Optional caption for the file
            $table->enum('type', ['image', 'video', 'flyer']); // Type of file
            $table->string('size')->nullable(); // Optional file size
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pameran_id')->references('id')->on('pamerans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pameran_files');
    }
};
