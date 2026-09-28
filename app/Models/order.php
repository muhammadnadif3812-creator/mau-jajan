<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Sesuaikan jika nama tabel di database kamu adalah 'orders' atau 'order'
    protected $guarded = ['id'];

    public function ordersDetails()
    {
        return $this->hasMany(orders_detail::class, 'order_id');
    }
}