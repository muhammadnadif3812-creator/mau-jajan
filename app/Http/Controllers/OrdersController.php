<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orders_detail; // Model kamu dinamai orders_detail
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        return view('customers.index', compact('foods'));
    }

    public function admindashboard()
    {
        $orders = order::with('ordersDetails.food')->latest()->get();
        return view('dashboard', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
{
    // Validasi agar status yang dikirim HANYA salah satu dari nilai ENUM database
    $request->validate([
        'status' => 'required|in:pending,diproses,Selesai'
    ]);
    
    $order = order::findOrFail($id); 
    $order->update(['status' => $request->status]);

    return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui!');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number'  => 'required|string|min:1',
            'items'         => 'required|array',
            'items.*'       => 'required|integer|min:0',
        ]);

        // Filter item yang kuantitasnya > 0
        $orderItems = array_filter($request->items, fn($qty) => $qty > 0);

        if (empty($orderItems)) {
            return back()->with('error', 'Pilih minimal satu menu makanan!');
        }

        DB::beginTransaction();
        try {
            $order = order::create([
                'customer_name' => $request->customer_name,
                'table_number'  => $request->table_number,
                'total_price'   => 0,
                'status'        => 'pending'
            ]);

            $totalPrice = 0;

            foreach ($orderItems as $foodId => $quantity) {
                $food = Food::findOrFail($foodId);
                $subtotal = $food->price * $quantity;
                $totalPrice += $subtotal;

                // Perbaikan: Gunakan orders_detail (sesuai import di atas)
                orders_detail::create([
                    'order_id' => $order->id,
                    'food_id'  => $food->id,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ]);
            }

            $order->update(['total_price' => $totalPrice]);
            
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Pesanan berhasil dibuat! Nomor Meja: ' . $order->table_number);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}