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
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel students
            $table->foreignId('student_id')->constrained();

            // ⭐ Kolom kategori (DITAMBAHKAN)
            $table->foreignId('payment_category_id')->constrained('payment_categories', 'id');

            // Nominal
            $table->bigInteger('amount');

            // Tanggal bayar
            $table->date('date_paid');

            // Catatan transaksi
            $table->text('transaction_note')->nullable();

            // Dibuat oleh user
            $table->foreignId('created_by')->constrained('users', 'id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_transactions');
    }
};
