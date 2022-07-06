@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Promotion Detail</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="button-list">
                    <a type="submit" class="btn btn-primary btn-rounded m-b-10 m-l-5" href="{{ route('sale_detailad.create') }}">Add
                        New Promotion Detail</a>
                    <div class="card-body">
                        <div class="row">
                            {{-- <form action="" class="row m-2">
                                <div class="row m-2">
                                    <input type="search" name="searchBrand" id="" class="form-control"
                                        style="border-style: groove" placeholder="What do you want?">
                                </div>
                                <div class=" btn-rounded m-b-10 m-l-5">
                                    <button type="submit"class="btn btn-info btn-rounded">Search</i></button>
                                </div>
                            </form> --}}
                        </div>
                        <div class="table-responsive m-t-40">
                            <table class="table table-bordered table-striped" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Promotion</th>
                                        <th>Product</th>
                                        <th style="text-align: center">Price Sale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstSaleDetail as $sdt)
                                        <tr>
                                            <td>{{ $sdt->id }}</td>
                                            <td>{{ $sdt->sale->name }}</td>
                                            <td>{{ $sdt->detail->capacity }}</td>
                                            <td >{{ $sdt->price_sale }}</td>
                                            <td><a class="btn btn-info btn-rounded"
                                                    href="{{ route('sale_detailad.edit', $sdt->id) }}"><i
                                                        class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('sale_detailad.destroy', $sdt->id) }}"
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
