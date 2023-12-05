<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function info(){
        return [
            "products"=>Product::where('state',1)->get()->count(),
            "users"=>User::where('status',1)->get()->count(),
            "sales"=>Sale::where('status',1)->get()->sum('total'),
            "purchases"=>Purchase::where('state',1)->get()->sum('total'),
            "months"=>$this->MonthSales(),
        ];
    }
    public function MonthSales()
    {
        $sales= Sale::select(
            DB::raw('sum(total) as total'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as month")
        )->where('status',1)
            ->groupBy('month')
            ->get();
            return $sales;
    }
}
