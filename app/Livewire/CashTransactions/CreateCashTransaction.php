<?php

namespace App\Livewire\CashTransactions;

use App\Livewire\Forms\StoreCashTransactionForm;
use App\Models\PaymentCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads; // ✅ WAJIB

class CreateCashTransaction extends Component
{
    use WithFileUploads; // ✅ WAJIB

    public StoreCashTransactionForm $form;

    public Collection $students;

    // sesuai dengan blade
    public $paymentCategories = [];

    public function mount(): void
    {
        $this->form->date_paid = now()->toDateString();

        // ambil kategori pembayaran
        $this->paymentCategories = PaymentCategory::orderBy('name')->get();
    }

    /**
     * Auto isi tagihan ketika kategori dipilih
     */
    public function updatedFormPaymentCategoryId($value): void
    {
        if ($value) {
            $category = PaymentCategory::find($value);
            $this->form->amount = $category?->price ?? 0;
        } else {
            $this->form->amount = 0;
        }
    }

    public function save(): void
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('cash-transaction-created')
            ->to(CashTransactionCurrentWeekTable::class);
    }

    public function render(): View
    {
        return view('livewire.cash-transactions.create-cash-transaction', [
            'students' => $this->students,
        ]);
    }
}
