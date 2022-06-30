@extends('layout_admin.layout')
@section('container')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Perfume Model</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="button-list">
                    <a class="btn btn-warning btn-rounded m-b-10 m-l-5" href="{{ route('productad.create') }}">Add New
                        Perfume Model</a>
                </div>
                <div class="row" style="padding: 15px">
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="" class="row m-2">
                            <div class="row m-2">
                                <input type="search" name="search" id="" class="form-control" style="border-style: groove" placeholder="What do you want?">
                            </div> 
                            <div class=" btn-rounded m-b-10 m-l-5">
                                <button type="submit"class="btn btn-info btn-rounded">Search</i></button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table class="table table-bordered table-striped" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Concentration</th>
                                    <th>Description</th>
                                    <th>Brand</th>
                                    <th>Scent</th>
                                    <th style="text-align: center">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lstProduct as $pd)
                                    <tr>
                                        <td>{{ $pd->id }}</td>
                                        <td>{{ $pd->name }}</td>
                                        <td>{{ $pd->concentration }}</td>
                                        <td>{{ $pd->description }}</td>
                                        <td>{{ $pd->brand->name_brand }}</td>
                                        <td>{{ $pd->scent->name_scent }}</td>
                                        <td><img src="{{ $pd->image }}" width="100px" height="100px"> </td>
                                        <td><a class="btn btn-info btn-rounded"
                                                href="{{ route('productad.edit', $pd->id) }}"> <i class="fa fa-edit"></a></td>
                                        <td>
                                            <form method="post" action="{{ route('productad.destroy', $pd->id) }}" style="text-align: center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"class="btn btn-info btn-rounded"><i
                                                        class="fa fa-trash"></i></button>
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


    {{-- <div class="row">
        <ul class="nav nav-tabs profile-tab" role="tablist">
            <li class="nav-item"> <a class="nav-link"  href="">ALL<span class="label label-rouded label-primary pull-right" style="margin-left:10px"></span></a> </li>
        <li class="nav-item"> <a class="nav-link"  href="">Stock <= 5<span class="label label-rouded label-primary pull-right" style="margin-left:10px"></span></a> </li>
            <select name="sort" id="sort" style="position:absolute;right:50px">
                <option value="">Select </option>
                <option value="{{ Request::url() }}?sort=giatang">Giá tăng dần</option>
                <option value="{{ Request::url() }}?sort=giagiam">Giá giảm dần</option>
                <option value="{{ Request::url() }}?sort=az">A->Z</option>
                <option value="{{ Request::url() }}?sort=za">Z->A</option>
            </select>
    </div> --}}