<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    function dashboardPage()
    {
        return view('pages.dashboard.dashboard-page');
    }
    function userProfilePage()
    {
        return view('pages.dashboard.profile-page');
    }
    function totalCustomer(Request $request)
    {
        $userId = $request->header('userId');
        return Customer::where('user_id', $userId)->count();
    }

    function totalProduct(Request $request)
    {
        $userId = $request->header('userId');
        return Product::where('user_id', $userId)->count();
    }

    
    function totalCategory(Request $request)
    {
        $userId = $request->header('userId');
        return Category::where('user_id', $userId)->count();
    }

    function totalSale(Request $request)
    {
        $userId = $request->header('userId');
        return Invoice::where('user_id', $userId)->count();
    }
}