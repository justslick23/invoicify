<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'quote_number',
        'client_id',
        'total_amount',
        'due_date',  // Add due_date to fillable

    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            $quote->quote_number = self::generateQuoteNumber();
        });
    }

    private static function generateQuoteNumber()
    {
        $year = date('Y');
        $month = date('m');
        $prefix = "QUO-{$year}-{$month}-";

        $lastQuote = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastQuote) {
            $lastSequence = intval(substr($lastQuote->quote_number, -3));
            $sequence = str_pad($lastSequence + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $sequence = '001';
        }

        return $prefix . $sequence;
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItems::class);
    }
}
