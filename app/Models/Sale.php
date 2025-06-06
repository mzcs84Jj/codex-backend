<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'customer_id',
        'total',
    ];

    protected $casts = [
        'date' => 'date',
        'total' => 'float',
    ];

    public function saleProducts()
    {
        return $this->hasMany(SaleProduct::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function updateTotal(): void
    {
        $total = 0;
        foreach ($this->saleProducts as $item) {
            $total += $item->price * $item->quantity;
        }
        $this->total = $total;
        $this->save();
    }
}
