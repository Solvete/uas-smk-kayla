<?php

namespace App\Livewire\Forms;

use App\Models\CashTransaction;
use App\Models\PaymentCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class StoreCashTransactionForm extends Form
{
    use WithFileUploads; // 🔥 WAJIB

    #[Validate('required|array|min:1')]
    public ?array $student_ids = [];

    #[Validate('required|exists:payment_categories,id')]
    public ?int $payment_category_id = null;

    #[Validate('required|numeric|min:0')]
    public ?string $amount = '';

    #[Validate('required|date')]
    public ?string $date_paid;

    public string $transaction_note = '';

    #[Validate('nullable|file|mimes:jpg,jpeg,png,pdf|max:2048')]
    public $payment_proof; // 🔥 WAJIB ADA

    /**
     * Ketika kategori berubah → auto isi amount
     */
    public function updatedFormPaymentCategoryId($id): void
    {
        $category = PaymentCategory::find($id);
        $this->amount = $category?->price ?? 0;
    }

    /**
     * Store
     */
    public function store(): void
    {
        $this->validate();

        $proofPath = null;

        // 🔥 SIMPAN FILE
        if ($this->payment_proof) {
            $proofPath = $this->payment_proof
                ->store('payment-proofs', 'public');
        }

        $now = now();

        $requests = collect($this->student_ids)->map(function ($studentID) use ($now, $proofPath) {
            return [
                'student_id'          => $studentID,
                'payment_category_id' => $this->payment_category_id,
                'amount'              => $this->amount,
                'date_paid'           => $this->date_paid,
                'transaction_note'    => $this->transaction_note,
                'payment_proof'       => $proofPath, // 🔥 DISIMPAN
                'created_by'          => Auth::id(),
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
        })->toArray();

        CashTransaction::insert($requests);

        $this->reset([
            'student_ids',
            'payment_category_id',
            'amount',
            'transaction_note',
            'payment_proof',
        ]);
    }
}
