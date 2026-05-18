<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function pay(Transaction $transaction)
    {
        if ($transaction->ticket->user_id !== Auth::id()) {
            abort(403);
        }

        // Simulate successful payment directly
        $transaction->update([
            'payment_status' => 'paid',
            'payment_date' => now(),
        ]);

        $transaction->ticket->update(['status' => 'active']);

        return redirect()->route('tickets.show', $transaction->ticket)->with('success', 'Payment successful!');
    }
}
