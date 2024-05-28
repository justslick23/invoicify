<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Client;
use App\Models\Product;

class QuoteController extends Controller
{


    public function index()
    {
        $quotes = Quote::all();
        return view('quotes.index', compact('quotes'));
    }


    public function create()
    {
        $year = date('Y');
        $month = date('m');
    
        // Get the last quote number for the current year and month
        $lastQuote = Quote::whereYear('created_at', $year)
                          ->whereMonth('created_at', $month)
                          ->orderBy('id', 'desc')
                          ->first();
    
        // Initialize sequence number
        $sequence = 1;
    
        // If there is a last quote, increment the sequence number
        if ($lastQuote) {
            $sequence = (int) substr($lastQuote->quote_number, -3) + 1;
        }
    
        // Generate the quote number
        $quoteNumber = "QUO-$year-$month-" . str_pad($sequence, 3, '0', STR_PAD_LEFT);
        $clients = Client::all();
        $products = Product::all();

        return view('quotes.create', compact('clients', 'quoteNumber', 'products'));
    }

    public function store(Request $request)
    {
         // Validate the incoming request data
         $request->validate([
            'client_id' => 'required',
            'due_date' => 'required|date',
            'subtotal' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
            'products.*' => 'required|exists:products,id',
            'quantities.*' => 'required|numeric|min:1',
            'prices.*' => 'required|numeric|min:0',
            'totals.*' => 'required|numeric|min:0',
        ]);

        // Create a new quote instance
        $quote = new Quote();
        $quote->client_id = $request->client_id;
        $quote->due_date = $request->due_date;
        $quote->subtotal = $request->subtotal;
        $quote->discount = $request->discount ?? 0;
        $quote->total = $request->total;
        $quote->save();

        // Save quote items
        for ($i = 0; $i < count($request->products); $i++) {
            $quote->items()->create([
                'product_id' => $request->products[$i],
                'quantity' => $request->quantities[$i],
                'price' => $request->prices[$i],
                'total' => $request->totals[$i],
            ]);
        }

        // Redirect back or to a different page
        return redirect()->route('quotes.index')->with('success', 'Quote created successfully');
    }
}
