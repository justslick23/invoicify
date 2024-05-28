<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['postal_code', 'country', 'city', 'district'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
}
