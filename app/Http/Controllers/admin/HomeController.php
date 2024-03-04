<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        $totalCategories = Category::count();
        $totalBrands = Brand::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role',1)->count();
        $totalOrders = Order::where('status','!=','cancelled')->count();
        $totalSales = Order::where('status','!=','cancelled')->sum('grand_total');

        //This month sales
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');
        $thisMonthName = Carbon::now()->startOfMonth()->format('M');

        $totalSalesThisMonth = Order::where('status','!=','cancelled')
                            ->whereDate('created_at','>=',$startOfMonth)
                            ->whereDate('created_at','<=',$currentDate)
                            ->sum('grand_total');

        //Last month sales
        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $lastMonthName = Carbon::now()->subMonth()->startOfMonth()->format('M');

        $totalSalesLastMonth = Order::where('status','!=','cancelled')
                            ->whereDate('created_at','>=',$lastMonthStartDate)
                            ->whereDate('created_at','<=',$lastMonthEndDate)
                            ->sum('grand_total');

        return view('admin.dashboard',[
            'totalCategories' => $totalCategories,
            'totalBrands' => $totalBrands,
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'totalSalesThisMonth' => $totalSalesThisMonth,
            'thisMonthName' => $thisMonthName,
            'totalSalesLastMonth' => $totalSalesLastMonth,
            'lastMonthName' => $lastMonthName
        ]);
        //$admin = Auth::guard('admin')->user();
        //echo 'Welcome '.$admin->name.' <a href="'.route('admin.logout').'">Logout</a>';
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
