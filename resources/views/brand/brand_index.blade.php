@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Brand</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="button-list">
                    <a type="submit" class="btn btn-primary btn-rounded m-b-10 m-l-5" href="{{ route('brand.create') }}">Add
                        New Brand</a>
                    <div class="card-body">
                        <div class="row">
                            <form action="" class="row m-2">
                                <div class="row m-2">
                                    <input type="search" name="searchBrand" id="" class="form-control"
                                        style="border-style: groove" placeholder="What do you want?">
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
                                        <th>Detail</th>
                                        <th style="text-align: center">Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstBrand as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->name_brand }}</td>
                                            <td>{{ $brand->detail }}</td>
                                            <td><img src="{{ $brand->image_brand }}" width="100px" height="100px"></td>
                                            <td><a class="btn btn-info btn-rounded"
                                                    href="{{ route('brand.edit', $brand->id) }}"><i
                                                        class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('brand.destroy', $brand->id) }}"
                                                    style="text-align: center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"class="btn btn-info btn-rounded btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
