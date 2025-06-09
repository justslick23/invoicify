<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'client_id',
        'quote_id',
        'status',
        'subtotal',
        'discount',
        'total',
        'due_date',  // Add due_date to fillable

    ];

    public static function getNextInvoiceNumber()
    {
        // Get the last invoice by ID (assuming invoice_number is always in format: INV-XXXXX)
        $lastInvoice = self::orderBy('id', 'desc')->first();
    
        if ($lastInvoice && preg_match('/INV-(\d+)/', $lastInvoice->invoice_number, $matches)) {
            $lastNumber = (int)$matches[1];
        } else {
            $lastNumber = 0;
        }
    
        $nextNumber = $lastNumber + 1;
    
        // Pad the number with leading zeros to 5 digits
        return 'INV-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
    


    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = self::getNextInvoiceNumber();
            }
        });
    }
    

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
