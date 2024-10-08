<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Detail;

class CartController extends Controller
{
    public function viewCart() {
        $cart_items = Session::get('cart_items');
        if(is_null($cart_items)) {
            $cart_items = [];
        }
        return view('cart/index', compact('cart_items'));
    }
    
    public function addToCart($id) {
        $product = Product::find($id);
        
        $cart_items = Session::get('cart_items');
        if(is_null($cart_items)) {
            $cart_items = array();
        }
        
        $qty = 0;
        if(array_key_exists($product->id, $cart_items)) {
            $qty = $cart_items[$product->id]['qty'];
        }
        
        $cart_items[$product['id']] = array(
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'image_url' => $product->image_url,
            'qty' => $qty + 1,
        );
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function deleteCart($id) {
        $cart_items = Session::get('cart_items');
        unset($cart_items[$id]);
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function updateCart($id, $qty) {
        $cart_items = Session::get('cart_items');
        $cart_items[$id]['qty'] = $qty;
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function checkout() {
        if(Session::get('cart_items')) {
            $cart_items = Session::get('cart_items');
            return view('cart/checkout', compact('cart_items'));
        } else {
            return redirect('/cart/view');
        }
    }

    public function complete(Request $request) {
        $cart_items = Session::get('cart_items');
        $cust_name = $request->input('cust_name');
        $cust_email = $request->input('cust_email');

        // ตรวจสอบว่ามีข้อมูลในตะกร้าหรือไม่
        if (empty($cart_items)) {
            return redirect('cart/view')->with('error', 'No items in cart.');
        }

        $po_no = 'PO' . date('Ymd') . rand(10, 99). rand(10, 99);   
        $po_date = date("d-m-Y H:i:s");
        $total_amount = 0;

        // บันทึกข้อมูล Order
        $order = new Order();
        $order->order_number = $po_no;
        $order->name = $cust_name;
        $order->email = $cust_email;
        $order->status = 0;
        $order->save();

        // บันทึกข้อมูล Order Detail สำหรับแต่ละรายการในตะกร้า
        foreach ($cart_items as $item) {
            $order_detail = new Order_Detail();
            $order_detail->order_id = $order->id;
            $order_detail->order_number = $order->order_number;
            $order_detail->order_name = $item['name'];  // ใช้ชื่อจากสินค้าในตะกร้า
            $order_detail->price = $item['price'];
            $order_detail->qty = $item['qty'];
            $order_detail->save();

            // คำนวณยอดรวม
            $total_amount += $item['price'] * $item['qty'];
        }

        // สร้าง PDF
        $html_output = view('cart/complete', compact('cart_items', 'cust_name', 'cust_email', 'po_no', 'po_date', 'total_amount'))->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output('output.pdf', 'I');

        return response()->withHeaders([
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function finish_order() {
        $cart_items = Session::get('cart_items'); 
        Session::remove('cart_items');
        return redirect('/');
    }
}
