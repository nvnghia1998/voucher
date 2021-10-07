@extends('admin.layout.master')
@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">

<form action="admin/danh-muc/sua/{{$item->id}}" method="POST">
    <div class="form-group">
        <label>Danh mục cha</label>
        <select class="form-control" name="selectParentId">
            <option value="0">Gốc</option>
            <?php listcate($cate, 0, $str = "", $item->parent_id ) ?>
        </select>
    </div>
    <div class="form-group">
        <label>Tên danh mục</label>
        <input class="form-control" name="txtCateName" placeholder="Nhập tên danh mục" value="{!! $item->name!!}"/>
    </div>
    <div class="form-group">
        <label>Tên danh mục đầy đủ</label>
        <input class="form-control" name="txtFullName" placeholder="Nhập tên đầy đủ" value="{!! $item->full_name!!}"/>
    </div>
    <button type="submit" class="btn btn-default">Lưu</button>
    <button type="reset" class="btn btn-default">Hủy</button>
    {{csrf_field()}}
<form>
</div>
</main>
</div>
@endsection