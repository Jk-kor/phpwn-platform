<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('billing_address')->nullable()->after('status');
            $table->string('billing_city')->nullable()->after('billing_address');
            $table->string('billing_zip')->nullable()->after('billing_city');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['billing_address', 'billing_city', 'billing_zip']);
        });
    }
};
