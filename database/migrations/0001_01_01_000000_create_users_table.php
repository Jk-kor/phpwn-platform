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
        // 1. Users 테이블 (가이드라인 필수 항목 포함)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // 필수
            $table->string('email')->unique();    // 필수
            $table->string('password');           // 필수
            $table->decimal('balance', 10, 2)->default(10000.00); // 필수: 잔액
            $table->enum('role', ['user', 'admin', 'creator'])->default('user'); // 필수: 역할
            $table->string('profile_picture')->default('default.png'); // 선택
            $table->text('bio')->nullable();      // 선택
            $table->string('skill_level')->default('Junior'); // 선택
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. 비밀번호 재설정 토큰 테이블 (라라벨 기본)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. 세션 테이블 (라라벨 기본)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};