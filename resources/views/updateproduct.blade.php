@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Update Product</h3> </div>
</div>
@stop
@section('main')
<div class="row">
    <div class="col-6">
        <div class="card">
        <div class="button-list">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            Name : <input type="text" name="ten_san_pham" value="0"/></br></br>
                            Description : <input type="text" name="mo_ta" value="0"/></br></br>
                            Catagory : <select name="ma_loai">
                                {{-- @foreach ($lstLoaiSanPham as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$sanPham->loai_san_pham_id) selected @endif>{{ $item->ten_loai }}</option>
                                @endforeach --}}
                            </select></br></br>
                            Price : <input type="text" name="don_gia" value="0" onkeypress='return event.charCode>=48 && event.charCode<=57'/></br></br>
                            Stock : <input type="text" name="so_luong" value="0" readonly /></br></br>
                            <label for="file">Image : </label>
                            <input type="file" name="hinh_anh" id="file"/>
                            <br/>
                            <input class="btn btn-primary btn-rounded m-b-10 m-l-5" type="submit" name="submit" value="Update"/>
                        </form>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <img src="" width="500px" height="500px">
                    </div>
</div>
                @stop