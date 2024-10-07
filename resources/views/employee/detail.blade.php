@extends('layouts.master')
@section('title') BikeShop | รายละเอียดการสั่งซื้อ @stop
@section('content')
{!! Form::model($orders, array('action' => 'App\Http\Controllers\OrderingController@changeStatus','method' => 'post', 'enctype' => 'multipart/form-data')) !!} {{-- เขียนชื่อ Controller ผิดนา --}}
{!! Form::model($orders, array('method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $orders->id }}">

    <div class="container">
        <h1>Order Detail</h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('employee/order') }}"><i class="fa fa-home"></i> รายการสั่งซื้อสินค้า</a></li>
            <li class="active">รายละเอียดการสั่งซื้อ</li>
        </ul>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    รายละเอียดการสั่งซื้อ
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered bs_table" style="width: 50%">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <th>เลขที่ใบสั่งซื้อ</th>
                            <td>{{ $orders->order_number }}</td>
                        </tr>
                        <tr>
                            <th>ชื่อลูกค้า</th>
                            <td>{{ $orders->name }}</td>
                        </tr>
                        <tr>
                            <th>อีเมล์</th>
                            <td>{{ $orders->email }}</td>
                        </tr>
                        <tr>
                            <th>วันที่สั่งซื้อสินค้า</th>
                            <td>{{ \Carbon\Carbon::parse($orders->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        <tr>
                            <th>สถานะการชำระเงิน</th>
                            <td><input type="checkbox" name="status" data-toggle="switchbutton" data-onlabel="ชำระเงินแล้ว" data-offlabel="ยังไม่ได้ชำระเงิน" data-onstyle="success" data-offstyle="danger" data-width="125" value = "1" {{ $orders->status ? 'checked' : '' }} onchange='this.form.submit()'> value คือ {{ $orders->status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        รายละเอียดสินค้า
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered bs_table">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อสินค้า</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>จำนวน</th>
                                <th>รวมเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $total = 0;
                            ?>
                            @foreach ($order_detail as $od)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $od->order_name }}</td>
                                    <td>{{ number_format($od->price, 2) }}</td>
                                    <td>{{ $od->qty }}</td>
                                    <td>{{ number_format($od->price * $od->qty, 2) }}</td>
                                </tr>
                                <?php
                                $count++;
                                $total += $od->price * $od->qty;
                                ?>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- แสดงยอดรวมทั้งหมด -->
                    <div style="text-align: right; margin-top: 20px;">
                        <strong>ยอดรวมทั้งหมด:</strong> <span>{{ number_format($total, 2) }} บาท</span>
                    </div>
                </div>

                <div class="panel-footer"></div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
    {!! Form::close() !!}
<script>
    
</script>
@endsection
