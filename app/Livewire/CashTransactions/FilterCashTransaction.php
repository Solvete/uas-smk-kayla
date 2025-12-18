<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Filter Transaksi Pembayaran')]
class FilterCashTransaction extends Component
{
    use WithPagination;

    protected StudentRepository $studentRepository;
    protected CashTransactionRepository $cashTransactionRepository;

    public ?string $selected_month = ''; // ex: 2025-12
    public ?string $selected_year  = ''; // ex: 2025
    public ?string $query = '';

    public ?array $statistics = [];

    public function boot(
        StudentRepository $studentRepository,
        CashTransactionRepository $cashTransactionRepository
    ): void {
        $this->studentRepository = $studentRepository;
        $this->cashTransactionRepository = $cashTransactionRepository;
    }

    public function mount(): void
    {
        $this->statistics = [
            'totalCurrentWeek'  => 0,
            'totalCurrentMonth' => 0,
            'totalCurrentYear'  => 0,
            'studentsNotPaidLimit' => collect(),
            'studentsNotPaid'      => collect(),
            'studentsNotPaidCount' => 0,
        ];
    }

    public function updated(): void
    {
        $this->resetPage();
    }

    /**
     * Ketika bulan dipilih, otomatis set tahun
     */
    public function updatedSelectedMonth($value): void
    {
        if ($value) {
            $this->selected_year = substr($value, 0, 4);
        }
    }

    /**
     * RESET FILTER (ini yang sebelumnya error)
     */
    public function resetFilters(): void
    {
        $this->selected_month = '';
        $this->selected_year  = '';
        $this->query = '';

        $this->resetPage();
    }

    public function render(): View
    {
        $start_date = null;
        $end_date   = null;

        if ($this->selected_month) {
            $start_date = $this->selected_month . "-01";
            $end_date   = date("Y-m-t", strtotime($start_date));
        }

        if ($this->selected_year && !$this->selected_month) {
            $start_date = $this->selected_year . "-01-01";
            $end_date   = $this->selected_year . "-12-31";
        }

        $sumAmountDateRange = 0;

        if ($start_date && $end_date) {
            $sumAmountDateRange = CashTransaction::whereBetween('date_paid', [$start_date, $end_date])
                ->sum('amount');
        }

        $filteredResult = CashTransaction::query()
            ->with('student', 'createdBy')
            ->when($this->query, fn (Builder $q) =>
                $q->whereHas('student', fn ($s) =>
                    $s->where('name', 'like', "%{$this->query}%")
                )
            )
            ->when($start_date && $end_date, fn ($q) =>
                $q->whereBetween('date_paid', [$start_date, $end_date])
            );

        if ($start_date && $end_date) {
            $status = $this->studentRepository->getStudentPaymentStatus($start_date, $end_date);

            $this->statistics['studentsNotPaidLimit'] = $status['studentsNotPaid']->take(6);
            $this->statistics['studentsNotPaid']      = $status['studentsNotPaid'];
            $this->statistics['studentsNotPaidCount'] = $status['studentsNotPaid']->count();
        }

        $sum = $this->cashTransactionRepository->calculateTransactionSums();

        $this->statistics['totalToday']        = local_amount_format($sum['today']);
        $this->statistics['totalCurrentWeek']  = local_amount_format($sum['week']);
        $this->statistics['totalCurrentMonth'] = local_amount_format($sum['month']);
        $this->statistics['totalCurrentYear']  = local_amount_format($sum['year']);

        return view('livewire.cash-transactions.filter-cash-transaction', [
            'filteredResult'     => $filteredResult->paginate(5),
            'sumAmountDateRange' => $sumAmountDateRange,
        ]);
    }
}