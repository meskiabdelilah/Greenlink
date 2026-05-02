<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('last_login_latitude', 10, 7)->nullable()->after('is_banned');
            $table->decimal('last_login_longitude', 10, 7)->nullable()->after('last_login_latitude');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_login_latitude', 'last_login_longitude']);
        });
    }
};
