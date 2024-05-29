<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Invoice;
class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice.client')->get();

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $invoices = Invoice::all();
        return view('payments.create', compact('invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $payment = new Payment();
        $payment->invoice_id = $request->invoice_id;
        $payment->amount = $request->amount;
        $payment->payment_method = $request->payment_method;
        $payment->notes = $request->notes;
        $payment->payment_date = now();
        $payment->save();

        // Calculate total payments for the invoice
        $totalPayments = Payment::where('invoice_id', $request->invoice_id)->sum('amount');

        // Retrieve the invoice
        $invoice = Invoice::findOrFail($request->invoice_id);

        // Update invoice status based on total payments
        if ($totalPayments >= $invoice->total) {
            $invoice->status = 'Paid';
        } else {
            $invoice->status = 'Partially Paid';
        }

        $invoice->save();

        return redirect()->route('payments.index')->with('success', 'Payment added successfully.');
    }
}
