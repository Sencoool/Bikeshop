<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Detail;

class OrderingController extends Controller
{
    var $rp = 7;

    public function index()
    {  
        $orders = Order::paginate($this->rp);
        return view('employee/index', compact('orders'));
    }   

   /* public function viewOrder()
    {
        return view('employee/index');                 
    }*/

    public function viewDetail($id) {

        $orders = Order::find($id);

        $order_detail = Order_Detail::where('order_number', $orders->order_number)->get();

        return view('employee/detail', compact('orders', 'order_detail'));
    }

    public function changeStatus(Request $request){
        $id = $request->id; //error ตั้งนานเพราะแม่งลืมส่ง id เข้า Function

        $orders = Order::find($id);
        $orders->status = $request->has('status') ? 1 : 0;
        $orders->save();

        return redirect('employee/order');
    }
}
