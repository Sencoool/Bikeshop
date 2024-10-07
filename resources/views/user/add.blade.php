@extends('layouts.master') @section('title') BikeShop | เพิ่มข้อมูลผู้ใช้ @stop
@section('content')
<div class="container">
    <h1>เพิ่มข้อมูลผู้ใช้</h1>
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('user') }}">หน้าแรก</a></li>
        <li class="active">เพิ่มข้อมูลผู้ใช้</li>
    </ul>
    {!! Form::open([
        'action' => 'App\Http\Controllers\UserController@insert',
        'method' => 'post',
        'enctype' => 'multipart/form-data',
    ]) !!} 
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>ข้อมูลผู้ใช้</strong>
            </div>
        </div>
        <div class="panel-body">
            <table>
                <tr>
                    <td>{{ Form::label('name', 'ชื่อผู้ใช้ ') }} </td>
                    <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
                </tr>
                
                <tr>
                    <td>{{ Form::label('email', 'อีเมล') }}</td>
                    <td>{{ Form::text('email', Request::old('email'), ['class' => 'form-control']) }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('password', 'รหัสผ่าน') }}</td>
                    <td>{{ Form::text('password', Request::old('password'), ['class' => 'form-control']) }}</td>
                </tr>
                
                <tr>
                    <td>{{ Form::label('level', 'ระดับ') }}</td>
                    <td>{{ Form::select('level', $Dropdown, ['class' => 'form-control']) }}
                    </td>
                </tr>
            </table>
    </div>
    <div class="panel-footer">
        <button type="reset" class="btn btn-danger">ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>

    </div>
    {!! Form::close() !!}
</div>
@endsection
