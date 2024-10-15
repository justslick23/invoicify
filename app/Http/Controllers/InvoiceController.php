<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Client;
use App\Models\Product;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;
use function Spatie\LaravelPdf\Support\pdf;
use TCPDF; // Make sure to import the TCPDF class
use Dompdf\Dompdf;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    // Method to display the invoice creation form
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
           // Get the current year and month
    $year = date('Y');
    $month = date('m');

    // Get the last invoice number for the current year and month
    $lastInvoice = Invoice::whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->orderBy('id', 'desc')
        ->first();

    // Extract the sequential number part and increment it
    $number = ($lastInvoice) ? (int)explode('-', $lastInvoice->invoice_number)[3] + 1 : 1;

    // Format the sequential number with leading zeros
    $sequentialNumber = str_pad($number, 3, '0', STR_PAD_LEFT);

    // Construct the invoice number
    $invoiceNumber = 'INV-' . $year . '-' . $month . '-' . $sequentialNumber;
        return view('invoices.create', compact('clients', 'products', 'invoiceNumber'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|in:Unpaid,Partially Paid,Paid,Overdue',
            'products.*' => 'required|exists:products,id',
            'quantities.*' => 'required|integer|min:1',
            'prices.*' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        // Create the invoice
        $invoice = Invoice::create([
            'client_id' => $validatedData['client_id'],
            'invoice_number' => $validatedData['invoice_number'],
            'due_date' => $validatedData['due_date'],
            'status' => $validatedData['status'],
            'subtotal' => $validatedData['subtotal'],
            'discount' => $validatedData['discount'],
            'total' => $validatedData['total'],

            // Add any other fields you need to save from the form
        ]);

        // Handle invoice items
        $invoiceItems = [];
        foreach ($validatedData['products'] as $key => $productId) {
            $quantity = $validatedData['quantities'][$key];
            $unitPrice = $validatedData['prices'][$key];
            $total = $quantity * $unitPrice;
        
            $invoiceItems[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total' => $total,
                // Add any other fields you need to save for each invoice item
            ];
        }
        
        $invoice->items()->createMany($invoiceItems);

        // Redirect or respond with a success message
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');
    }

    public function generatePdf($id)
    {
        // Increase execution time limit to 300 seconds
        ini_set('max_execution_time', 300); // Adjust the value based on the complexity of your PDF
        ini_set('memory_limit', '512M');

        // Load the invoice data from the database
        $invoice = Invoice::with('items.product', 'client')->findOrFail($id);
    
        // Render the Blade view with the invoice data
        $html = view('invoices.pdf', compact('invoice'))->render();
    
        // Generate PDF using Snappy PDF facade with custom options
        $pdf = PDF::loadHTML($html);
    
        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '', $invoice->invoice_number);
        return $pdf->stream("{$fileName}.pdf");
        
    }
    
}
