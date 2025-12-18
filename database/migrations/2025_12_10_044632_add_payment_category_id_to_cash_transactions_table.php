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
        Schema::table('cash_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('cash_transactions', 'payment_category_id')) {
                $table->foreignId('payment_category_id')
                    ->nullable() //️⃣ penting supaya tidak error FK
                    ->after('student_id')
                    ->constrained('payment_categories', 'id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cash_transactions', function (Blueprint $table) {
            if (Schema::hasColumn('cash_transactions', 'payment_category_id')) {

                // Drop foreign key dulu
                $table->dropForeign(['payment_category_id']);

                // Drop column
                $table->dropColumn('payment_category_id');
            }
        });
    }
};
