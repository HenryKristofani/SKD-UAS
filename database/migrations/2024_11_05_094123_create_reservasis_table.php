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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to 'users' table
            $table->string('nama_ketua');
            $table->string('nik_ketua');
            $table->string('ktp_ketua_path'); // Path to KTP image
            $table->string('telepon_ketua');
            $table->text('alamat_ketua');
            $table->json('anggota'); // JSON data for group members
            $table->timestamps();

            // Define the foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
