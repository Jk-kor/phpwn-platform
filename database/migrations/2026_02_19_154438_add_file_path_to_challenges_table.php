<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            // flag가 아니라 flag_hash가 실제 컬럼명일 확률이 높으므로 수정
            // 만약 그것도 확실치 않다면 그냥 맨 뒤에 추가하도록 바꿉니다.
            if (Schema::hasColumn('challenges', 'flag_hash')) {
                $table->string('file_path')->nullable()->after('flag_hash');
            } else {
                $table->string('file_path')->nullable(); // 위치 지정 없이 추가
            }
        });
    }

    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            if (Schema::hasColumn('challenges', 'file_path')) {
                $table->dropColumn('file_path');
            }
        });
    }
};