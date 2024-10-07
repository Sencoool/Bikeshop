@extends("layouts.master") @section('title') BikeShop | แก้ไขข้อมูลประเภทสินค้า @stop
@section('content')

@if($errors->any())
<div class="alert alert-danger">
@foreach ($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif

<div class="container">
    <h1>แก้ไขประเภทสินค้า </h1>
<ul class="breadcrumb">
<li><a href="{{ URL::to('category') }}">หน้าแรก</a></li>
<li class="active">แก้ไขสินค้า </li>
</ul>
{!! Form::model($category, array('action' => 'App\Http\Controllers\CategoryController@update','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $category->id }}">
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">
<strong>ข้อมูลสินค้า </strong>
</div>
</div>
<div class="panel-body">
<table>
{!! Form::model($category, array('method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $category->id }}">
<table>

<tr>
    <td>{{ Form::label('name', 'ชื่อประเภทสินค้า') }} </td>
    <td>{{ Form::text('name', $category->name, ['class' => 'form-control']) }}</td>
</tr>

</table>
</div>
<div class="panel-footer">
<button type="reset" class="btn btn-danger">ยกเลิก</button>

<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
</div>
</div>

{!! Form::close() !!}

{!! Form::close() !!}
</div>
@endsection