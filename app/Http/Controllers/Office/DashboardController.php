<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $inspiring = Artisan::command('inspire', function () {
            $this->comment(Inspiring::quote());
        })->describe('Display an inspiring quote');
        $pesanan = Order::where("st", "Wait for confirmation")->get()->count();
        $customer = User::where("role", "Customer")->get()->count();
        $penjualan = Order::where("st", "Order on process")->get()->count();
        $terima = Order::where("st", "Received")->get()->count();
        return view('page.office.dashboard.main', compact('inspiring', 'pesanan', 'customer', 'penjualan', 'terima'));
    }
}
