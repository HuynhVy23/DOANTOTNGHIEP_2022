@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Add New Flower</h3> 
    </div>
</div>
@stop
@section('main')
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="button-list">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            Name : <input type="text" name="ten_san_pham"/>
            <em style="color: red"></em>
            Description : <input type="text" name="mo_ta"/>
            <em style="color: red"></em>
            Catagory : <select name="ma_loai">
                <option value="">--Select catagory--</option>
                {{-- @foreach ($lstLoaiSanPham as $item)
                    <option value="{{ $item->id }}">{{ $item->ten_loai }}</option>
                @endforeach --}}
            </select></br></br>
            Price : <input type="text" name="don_gia"/>
            <em style="color: red"> </em>
            Stock : <input type="text" name="so_luong" value="0" readonly/></br></br>
            <label for="file">Image : </label>
            <input type="file" name="hinh_anh" id="file"/>
            <br/>
            <input class="tg-btn" type="submit" name="submit" value="Submit"/>
        </form>
        </div>
            </div>
    </div>
</div>
@stop