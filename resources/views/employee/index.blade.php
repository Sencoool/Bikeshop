@extends('layouts.master')
@section('title') BikeShop | การสั่งซื้อสินค้า @stop
@section('content')

    <div class="container">
        <h1>Order </h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('product') }}"><i class="fa fa-home"></i>หน้าร้าน</a></li>
            <li class="active">รายการสั่งซื้อสินค้า </li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><strong>Order</strong></div>
            </div>



            <table class="table table-bordered  bs_table">
                <thead>
                    <tr>
                        <th>OrderID</th>
                        <th>เลขที่ใบสั่งซื้อ</th>
                        <th>ชื่อลูกค้า</th>
                        <th class="bs-center">วันที่สั่งซื้อสินค้า</th>
                        <th class="bs-center">รายละเอียด</th>
                        <th class="bs-center">สถานะการชำระเงิน</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    @foreach ($orders as $o)
                        <tr>
                            <th style="vertical-align: middle;">{{ sprintf('%03d', $o->id) }}</th>
                            <th style="color: rgb(76, 76, 251); vertical-align: middle;">{{ $o->order_number }}</th>
                            <th style="vertical-align: middle;">{{ $o->name }}</th>
                            <th class="bs-center" style="vertical-align: middle;">{{ \Carbon\Carbon::parse($o->created_at)->format('Y/m/d') }}</th>
                            <th class="bs-center" style="vertical-align: middle;">
                                <a href="{{ URL::to('employee/detail/' . $o->id) }}"> รายละเอียด </a>
                            </th>
                            @if ($o->status == 0)
                            <th class="alert alert-danger"> 
                                ยังไม่ได้ชำระเงิน    
                            </th>
                            @else
                            <th class="alert alert-success"> 
                                ชำระเงินแล้ว
                            </th>
                            @endif
                        </tr>
                    @endforeach
            </table>
            <div class="panel-footer">
                <span>แสดงข้อมูลจํานวน {{ count($orders) }} รายการ</span>
            </div>
        </div>
        <div class="container">
            {{ $orders->links() }}
        </div>
        <!--<script>
            function togglePayment(event) {
                var th = event.currentTarget; // ใช้ currentTarget เพื่ออ้างถึง th ที่ถูกคลิก

                // ตรวจสอบสถานะปัจจุบันและสลับสถานะ
                if (th.innerHTML === "ชำระเงินแล้ว") {
                    th.innerHTML = "ยังไม่ได้ชำระ";
                    th.style.backgroundColor = "red";
                } else {
                    th.innerHTML = "ชำระเงินแล้ว";
                    th.style.backgroundColor = "green";
                }
            }
        </script>-->
    @endsection
