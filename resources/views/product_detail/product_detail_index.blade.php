@extends('layout_admin.layout')
@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Perfume</h3> </div>
</div>
@stop
@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="button-list">
        <a class="btn btn-warning btn-rounded m-b-10 m-l-5" href="{{ route('product_detail.create') }}">Add New Perfume</a></div>
        <div class="row" style="padding: 15px">
        <form action="" method="GET">
            @csrf
            <input type="text" name="ten_san_pham" placeholder="Name">
            <input type="text" name="mo_ta" placeholder="Description">
            {{-- <select name="ma_loai">
                <option value="">Select category</option>
                @foreach ($lstLoaiSanPham as $item)
                <option value="{{ $item->id }}">{{ $item->ten_loai }}</option>
                @endforeach
            </select> --}}
            <input type="text" name="gia_thap" placeholder="From(price)" >
            <input type="text" name="gia_cao" placeholder="To(price)" >
            <button type="submit"class="btn btn-info btn-rounded"><i class="fa fa-search"></i></button>
        </form>
                
        </div>
            <div class="card-body">
                <div class="row">
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        {{-- <li class="nav-item"> <a class="nav-link"  href="">ALL<span class="label label-rouded label-primary pull-right" style="margin-left:10px"></span></a> </li>
                        <li class="nav-item"> <a class="nav-link"  href="">Stock <= 5<span class="label label-rouded label-primary pull-right" style="margin-left:10px"></span></a> </li> --}}
                        <select name="sort" id="sort" style="position:absolute;right:50px">
                            <option value="">Select </option>
                            <option value="{{ Request::url() }}?sort=giatang">Giá tăng dần</option>
                            <option value="{{ Request::url() }}?sort=giagiam">Giá giảm dần</option>
                            <option value="{{ Request::url() }}?sort=az">A->Z</option>
                            <option value="{{ Request::url() }}?sort=za">Z->A</option>
                        </select>
                </div>
            <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Capacity</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Model Perfume</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lstProductDetail as $pddt)
                        <tr>
                            <td>{{ $pddt->id }}</td>
                            <td>{{ $pddt->capacity }}</td>
                            <td>{{ $pddt->price }}</td>
                            <td>{{ $pddt->stock }}</td>
                            <td>{{ $pddt->product->name }}</td>
                            <td>{{ $pddt->status }}</td>
                            <td><a class="btn btn-info btn-rounded" href="{{ route('product_detail.edit',$pddt->id) }}"> Update</a></td>
                            <td><form method="post" action="{{route('product_detail.destroy',$pddt->id)}}">
                                @csrf
                                @method('DELETE')
                                    <button type="submit"class="btn btn-info btn-rounded"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    
            {{-- </div>
            {{ $lstSanPham->appends(request()->all())->links() }}
            </div> --}}
        </div>
        </div>
    </div>
</div>

@stop
