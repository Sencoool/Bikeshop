@extends("layouts.master") @section('title') BikeShop | เพิ่มสินค้า @stop
@section('content')
{!! Form::open(array('action' => 'App\Http\Controllers\ProductController@insert','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<div class="container">
<input type="hidden" name="id" >
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">
<strong>ข้อมูลสินค้า </strong>
</div>
</div>
<div class="panel-body">
<table>
    <tr>
        <td>{{ Form::label('code','รหัสสินค้า')}}</td> {{-- label คือข้อความ --}}
        <td>{{ Form::text('code',Request::old('code'),['class' => 'form-control'])}}</td> {{--  text คือ input text --}}
    </tr>
    
    <tr>
        <td>{{ Form::label('name', 'ชื่อสินค้า ') }}</td>
        <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
        </tr>
        <tr>
        <td>{{ Form::label('category_id', 'ประเภทสินค้า ') }}</td>
        <td>{{ Form::select('category_id', $categories, Request::old('category_id'),
        ['class' => 'form-control']) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('branch_id', 'สาขา ') }}</td>
            <td>{{ Form::select('branch_id', $branches, Request::old('branch_id'),
            ['class' => 'form-control']) }}</td>
        </tr>
        
        <tr>
        <td>{{ Form::label('stock_qty', 'คงเหลือ') }}</td>
        <td>{{ Form::text('stock_qty', Request::old('stock_qty'), ['class' => 'form- control']) }}</td>
        </tr>
        
        <tr>
        <td>{{ Form::label('price', 'ราคาขายต่อ หน่วย') }}</td>
        <td>{{ Form::text('price', Request::old('price'), ['class' => 'form-control']) }}</td>
        </tr>
        <tr>
        <td>{{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
        <td>{{ Form::file('image') }}</td>
        </tr>
       
</table>
</div>
</div>

<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> บันทึก</button>
<button type="reset" class="btn btn-danger pull-right">ยกเลิก</button>

{!! Form::close() !!}

@endsection