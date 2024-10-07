@extends("layouts.master") @section('title') BikeShop | เพิ่มประเภทสินค้า @stop
@section('content')
{!! Form::open(array('action' => 'App\Http\Controllers\CategoryController@insert','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<div class="container">
<input type="hidden" name="id" >
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">
<strong>เพิ่มข้อมูลประเภทสินค้า </strong>
</div>
</div>
<div class="panel-body">
<table>
    <tr>
        <td>{{ Form::label('name','ชื่อประเภทสินค้า')}}</td> {{-- label คือข้อความ --}}
        <td>{{ Form::text('name',Request::old('name'),['class' => 'form-control'])}}</td> {{--  text คือ input text --}}
    </tr>
       
</table>
</div>
</div>

<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> บันทึก</button>
<button type="reset" class="btn btn-danger pull-right">ยกเลิก</button>

{!! Form::close() !!}

@endsection