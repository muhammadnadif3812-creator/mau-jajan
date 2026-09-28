<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Perbaikan Typo Factories
use Illuminate\Database\Eloquent\Model;

class orders_detail extends Model
{
    use HasFactory; // 2. Tambah titik koma (;)

    protected $table = 'order_details';
    protected $guarded = ['id']; // 3. Perbaikan Typo $guarded

    // 4. Relasi ke model Food
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id'); // 5. Ubah ke belongsTo & fix return
    }

    // 5. Relasi ke model Orders
    public function order()
    {
        return $this->belongsTo(orders_detail::class, 'order_id'); // Ubah ke belongsTo & sesuaikan nama model Order/Orders
    }
}