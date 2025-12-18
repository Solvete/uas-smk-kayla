<?php

use App\Livewire\Administrators\AdministratorTable;
use App\Livewire\Authentication\Login;
use App\Livewire\Authentication\Logout;
use App\Livewire\CashTransactions\CashTransactionCurrentWeekTable;
use App\Livewire\CashTransactions\FilterCashTransaction;
use App\Livewire\Dashboard;
use App\Livewire\SchoolClasses\SchoolClassTable;
use App\Livewire\SchoolMajors\SchoolMajorTable;
use App\Livewire\Students\StudentTable;
use App\Livewire\UpdateProfile;
use App\Livewire\Homepage; // ⬅️ tambahkan ini
use Illuminate\Support\Facades\Route;
use App\Livewire\PaymentCategories;
use App\Http\Controllers\CashReceiptController;
use Illuminate\Support\Facades\Storage;
use App\Models\CashTransaction;



// 🔹 Halaman public (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', Homepage::class)->name('home'); // ⬅️ Ganti dari Login jadi Homepage
    Route::get('/login', Login::class)->name('login');
});

// 🔹 Halaman private (sudah login)
Route::middleware('auth')->group(function () {

    Route::post('/logout', Logout::class)->name('logout');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/kelas', SchoolClassTable::class)->name('school-classes.index');
    Route::get('/jurusan', SchoolMajorTable::class)->name('school-majors.index');
    Route::get('/pengguna', AdministratorTable::class)->name('administrators.index');
    Route::get('/profil', UpdateProfile::class)->name('update-profiles.index');
    Route::get('/pelajar', StudentTable::class)->name('students.index');
    Route::get('/payment-categories', PaymentCategories::class)->name('payment.categories');

    Route::get('/kas', CashTransactionCurrentWeekTable::class)
        ->name('cash-transactions.index');

    Route::get('/kas/filter', FilterCashTransaction::class)
        ->name('cash-transactions.filter');

    // 🧾 PRINT INVOICE
    Route::get('/cash-transactions/{id}/receipt', [CashReceiptController::class, 'download'])
        ->name('cash.receipt.download');

    // ⬇️ DOWNLOAD BUKTI BAYAR
    Route::get('/cash-transactions/{cashTransaction}/download-proof', function (CashTransaction $cashTransaction) {

        abort_if(!$cashTransaction->proof_of_payment, 404);

        return Storage::disk('public')->download(
            $cashTransaction->proof_of_payment
        );

    })->name('cash-transactions.download-proof');

});

