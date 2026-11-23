<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Order;
use App\Models\SupportMessage;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalTickets = Order::whereRaw('LOWER(payment_status) = ?', ['lunas'])->sum('ticket_qty');
        $totalRevenue = Order::whereRaw('LOWER(payment_status) = ?', ['lunas'])->sum('total_price');
        $pendingVerification = Order::where('payment_status', 'Menunggu Verifikasi')
            ->orWhere(function ($q) {
                $q->whereNotNull('payment_proof')->whereRaw('LOWER(payment_status) != ?', ['lunas']);
            })->count();

        $latestOrders = Order::orderBy('created_at', 'desc')->take(8)->get();
        $totalUsers = User::count();
        $totalNews = Berita::count();
        $unhandledMessages = SupportMessage::where('status', 'baru')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalTickets',
            'totalRevenue',
            'pendingVerification',
            'latestOrders',
            'totalUsers',
            'totalNews',
            'unhandledMessages'
        ));
    }
}
