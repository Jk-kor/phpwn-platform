<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category'); // Web, Pwn, Crypto, etc.
            $table->string('difficulty'); // Noob, Mid, Hard, Insane
            $table->decimal('price', 20, 2)->default(0);
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // 작성자
            $table->string('image_url')->nullable();
            $table->string('access_url')->nullable();
            $table->string('flag_hash'); // 정답 (암호화)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};