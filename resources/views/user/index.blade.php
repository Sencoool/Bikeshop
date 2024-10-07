@extends('layouts.master')
@section('title') BikeShop | รายการสินค้า @stop
@section('content')
    <div class="container">
        <h1>Customer</h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li>
            <li class="active">Customer </li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><strong>รายการข้อมูลผู้ใช้</strong></div>
            </div>
            <div class="panel-body">
                <!-- search form -->
                <form action="{{ URL::to('user/search') }}" class="form-inline">
                    {{ csrf_field() }}
                    <input type="text" name="q" class="form-control" placeholder="...">
                    <button type="submit" class="btn btn-primary">ค้นหา <i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            {!! Form::model($users, ['method' => 'post', 'enctype' => 'multipart/form-data']) !!}

           
        </div>
        <table class="table table-bordered  bs_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>วันที่สร้าง</th>
                    <th>Level</th>
                    <th>การทำงาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>{{ $user->level }}</td>
                        <td class="bs-center">
                            <a href="{{ URL::to('user/edit/' . $user->id) }}" class="btn btn-info"><i
                                    class="fa fa-edit"></i> แก้ไข</a>
                            <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $user->id }}"><i
                                    class="fa fa-trash"></i> ลบ</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-footer">
            <span>แสดงข้อมูลจํานวน {{ count($users) }} รายการ</span>
        </div>
        <br>
        <br>
        <center><a href="{{ URL::to('user/add') }}" class="btn btn-success">เพิ่มข้อมูลผู้ใช้ <i class="fa-solid fa-user-plus"></i></a></center>
        <br>
        <br>
    </div>
    <script>
        $('.btn-delete').on('click', function() {
            if (confirm("คุณต้องการลบข้อมูลผู้ใช้ใช่หรือไม่")) {
                var url = "{{ URL::to('user/remove') }}" + '/' + $(this).attr('id-delete');
                window.location.href = url;
            }
        });
    </script>
@endsection
