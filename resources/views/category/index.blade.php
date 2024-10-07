@extends("layouts.master")
@section('title') BikeShop | รายการประเภทสินค้า @stop
@section('content')
<div class="container">
    <h1>รายการประเภทสินค้า </h1>
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title"><strong>รายการ</strong></div>
</div>
<div class="panel-body">
<!-- search form -->
<form action="{{ URL::to('category/search') }}" method="POST" class="form-inline"> 
{{ csrf_field() }}
<input type="text" name="q" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา"> {{-- name q คือตัวแปรที่ประกาศไว้สำหรับใช้ Search --}}
<a href="{{ URL::to('category/edit')}}" class="btn btn-success pull-right">เพิ่มสินค้า</a>
<button type="submit" class="btn btn-primary">ค้นหา</button>
</form>
</div>
    <table class="table table-bordered  bs_table"> {{-- ปิด Table ไม --}}
    <thead>
        <tr>
            <th>รหัส</th>
            <th>ชื่อประเภท</th>
            <th>การทำงาน</th>
        </tr>
    </thead>
    <tbody>
        @foreach($category as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td class="bs-center">
                <a href="{{ URL::to('category/edit/'.$p->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p->id }}"><i class="fa fa-trash"></i> ลบ</a>
            </td>
        </tr> @endforeach
    </tbody>
</table>
<div class="panel-footer">
        <span>แสดงข้อมูลจํานวน {{ count($category) }} รายการ</span>
</div>
</div>
<div class="container">
    {{ $category->links() }}
</div>
<script>
    $('.btn-delete').on('click',function() {if (confirm("คุณต้องการลบข้อมูลสินค้าใช่หรือไม่")) {
        var url = "{{ URL::to('category/remove') }}" + '/' + $(this).attr('id-delete');
        window.location.href = url;
    }}); // js connect string use " + " php use " . "
</script>
@endsection
