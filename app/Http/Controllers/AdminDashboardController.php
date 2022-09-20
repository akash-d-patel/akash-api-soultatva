<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends BaseController
{
    public function dashboardCount()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::where('status', 'Active')->count();
        $totalCategories = Category::where('status', 'Active')->count();
        $totalEnquiries = Contact::count();
        $totalUsers = User::where('status', 'Active')->count();
        return $this->sendResponse(compact('totalOrders', 'totalProducts', 'totalCategories', 'totalEnquiries', 'totalUsers'), 'Total counts');
    }
}
