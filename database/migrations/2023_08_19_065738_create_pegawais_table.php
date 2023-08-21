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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('name');
            $table->string('email');
            $table->integer('nik');
            $table->string('birth-place');
            $table->date('birth-date');
            $table->enum('gender',['Pria','Wanita']);
            $table->integer('phone-number');
            $table->enum('position',['Layanan','Research & Development','Produksi']);
            $table->enum('status',['Lajang','Menikah']);
            $table->string('address');
            $table->string('work-experience');
            $table->integer('years-of-experience');
            $table->string('photo')->nullable();
            $table->string('cv')->nullable();
            $table->string('supporting-documents')->nullable();
            $table->string('last-diploma')->nullable();
            $table->string('transcript')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
