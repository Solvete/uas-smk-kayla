<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class CashReceiptController extends Controller
{
   public function download($id)
{
    $transaction = CashTransaction::findOrFail($id);


    $pdf = PDF::loadView('pdf.receipt', [
        'transaction' => $transaction,
    ])->setPaper('a4', 'landscape');

    return $pdf->download('struk-smk-mcp-'.$transaction->id.'.pdf');
}

}
