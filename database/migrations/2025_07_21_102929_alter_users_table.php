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
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('registration_status')
                ->default(0)
                ->after('user_type')
                ->comment('0: UNPAID, 1: SUBSCRIBED_COMPLETED, 2: Subscription Active, 3: Subscription Inactive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('registration_status');
        });
    }
};
