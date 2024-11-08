<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Client;
use App\Models\Product;
use PDF;

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
            'terms' => 'nullable|string',
            'products.*' => 'required|exists:products,id',
            'descriptions.*' => 'nullable|string',
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
        $quote->terms = $request->terms;
        $quote->save();
    
        // Save quote items with descriptions
        for ($i = 0; $i < count($request->products); $i++) {
            $quote->items()->create([
                'product_id' => $request->products[$i],
                'description' => $request->descriptions[$i] ?? null,
                'quantity' => $request->quantities[$i],
                'price' => $request->prices[$i],
                'total' => $request->totals[$i],
            ]);
        }
    
        // Redirect back or to a different page
        return redirect()->route('quotes.index')->with('success', 'Quote created successfully');
    }
    
    public function generatePdf($id)
    {
        // Load the invoice data from the database
        $quote = Quote::with('items.product', 'client')->findOrFail($id);
    
        // Render the Blade view with the invoice data
        $html = view('quotes.pdf', compact('quote'))->render();
    
        // Generate PDF using Snappy PDF facade with custom options to include external CSS
        $pdf = PDF::loadHTML($html);
    
        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '', $quote->quote_number);
        return $pdf->stream("{$fileName}.pdf");
        
    }

    public function edit($id)
    {
        $quote = Quote::with('items.product', 'client')->findOrFail($id);
        $products = Product::all(); // Fetch products to populate the dropdown
        $clients = Client::all(); // Fetch clients for the client dropdown
        return view('quotes.edit', compact('quote', 'products', 'clients'));
    }
    public function update(Request $request, $id)
    {
        // Validate incoming request, including terms and description
        $request->validate([
            'quote_number' => 'required|string|max:255',
            'total' => 'required|numeric',
            'due_date' => 'required|date',
            'products' => 'required|array',
            'quantities' => 'required|array',
            'prices' => 'required|array',
            'products.*' => 'required|exists:products,id', // Ensure product IDs are valid
            'quantities.*' => 'required|numeric|min:1', // Ensure quantities are valid
            'prices.*' => 'required|numeric|min:0', // Ensure prices are valid
            'discount' => 'nullable|numeric|min:0', // Discount is optional but must be valid if present
            'terms' => 'nullable|string', // Validate terms if provided
            'description' => 'nullable|string', // Validate description if provided
        ]);
    
        // Find the existing quote
        $quote = Quote::findOrFail($id);
    
        // Update the quote details, including terms and description
        $quote->update([
            'quote_number' => $request->quote_number,
            'due_date' => $request->due_date,
            'discount' => $request->discount ?? 0, // Default to 0 if not provided
            'terms' => $request->terms, // Save terms if provided
            'description' => $request->description, // Save description if provided
        ]);
    
        // Calculate subtotal and update quote items
        $subtotal = 0;
        $quote->items()->delete(); // Remove existing items
    
        foreach ($request->products as $index => $productId) {
            $quantity = $request->quantities[$index];
            $price = $request->prices[$index];
            $total = $quantity * $price;
    
            $quote->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price, // Assuming you meant unit_price instead of price
                'total' => $total,
            ]);
    
            // Accumulate subtotal
            $subtotal += $total;
        }
    
        // Update the quote subtotal
        $quote->subtotal = $subtotal;
        $quote->total = $subtotal - ($request->discount ?? 0); // Calculate total after discount
        $quote->save(); // Save the updated quote with subtotal and total
    
        return redirect()->route('quotes.index')->with('success', 'Quote updated successfully.');
    }
    
    
        
}
