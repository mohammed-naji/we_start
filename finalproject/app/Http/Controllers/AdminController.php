<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function orders()
    {
        $orders = Order::latest('id')->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function payments()
    {
        $payments = Payment::latest('id')->paginate(10);
        return view('admin.payments', compact('payments'));
    }

    public function customers()
    {
        $customers = User::where('type', 'customer')->latest('id')->paginate(10);
        return view('admin.customers', compact('customers'));
    }

    public function admins()
    {
        $admins = User::where('type', 'admin')->latest('id')->paginate(10);
        return view('admin.admins', compact('admins'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function settings_data(Request $request)
    {
        $logo = setting('logo');
        if($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('uploads/logo', 'custom');
        }

        setting()->set('site_name', $request->site_name);
        setting()->set('logo', $logo);
        setting()->set('facebook', $request->facebook);
        setting()->set('twitter', $request->twitter);

        setting()->save();

        return redirect()->back();
    }
}
