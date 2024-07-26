<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Carbon;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        return view('dashboard.orders.index', [
            'orders' => Order::all(),
        ]);
    }

    public function store(Request $request, Order $order)
    {

        $messages = [
            'date_book.after_or_equal' => 'Tanggal booking harus setelah atau sama dengan tanggal hari ini.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:13',
            'email' => 'required|email:dns',
            'name_package' => 'required',
            'date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::today()->format('Y-m-d'),
            ]], $messages);

        $validatedData['status'] = 'pending';

        $order->timestamps = false;
        Order::create($validatedData);

        return redirect('/')->with('success', 'Your booking has been received!');
    }

    public function updateStatus(Request $request, Order $order){
        $order = Order::find($order->id);

        $action = $request->input('status');

        if ($action === 'success') {
            $order->status = 'success';
            $body = 'Selamat Booking Atas Nama ' . $order->name . ' Untuk ' . $order->name_package . ' Pada Tanggal ' . $order->date .  ' Telah Berhasil di Terima oleh Admin ';
        } elseif ($action === 'rejected') {
            $order->status = 'rejected';
            $body = 'Mohon Maaf Booking Atas Nama ' . $order->name . ' Untuk ' . $order->name_package . ' Pada Tanggal ' . $order->date .  ' Telah Gagal di Terima oleh Admin ';
        }

        $data = [
            'title' => 'INFORMASI BOOKING WEDDING ORGANIZER JWP',
            'body' => $body,
        ];

        $tujuan = $order->email;
        Mail::to($tujuan)->send(new OrderReceived($data));

        $order->timestamps = false;
        $order->save();

        return redirect('/dashboard/orders')->with('success', 'Status Updated');
    }

    public function destroy(Order $order)
    {
        $order = Order::find($order->id);
        $order->delete();

        return redirect('/dashboard/orders')->with('success', 'order has been deleted!');
    }
}
