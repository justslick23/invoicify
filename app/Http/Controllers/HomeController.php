<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Quote;
use App\Models\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalClients = Client::count();
        $totalAmount = Invoice::sum('total');
        $totalPaid = Invoice::where('status', 'Paid')->sum('total');
        $totalDue = $totalAmount - $totalPaid;
        $totalProducts = Product::count();
        $totalInvoices = Invoice::count();
        $totalPaidInvoices = Invoice::where('status', 'Paid')->count();
        $payments = Payment::all(['payment_date', 'amount']);

        $totalQuotes = Quote::count(); // You need to replace this with the actual logic to count quotes

        return view('dashboard', compact('totalClients', 'totalAmount', 'payments', 'totalPaid', 'totalDue', 'totalProducts', 'totalInvoices', 'totalPaidInvoices', 'totalQuotes'));
    }
}
