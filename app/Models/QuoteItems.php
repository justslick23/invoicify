<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote_id',
        'product_id',
        'quantity',
        'price',
        'total', 'description'
    ];
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
