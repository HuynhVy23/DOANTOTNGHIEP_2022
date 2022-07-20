@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add New Perfume</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('product_detail.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="capacity" class="col-form-label">Capacity: </label><br>
                <input type="text" class="form-control" name="capacity" placeholder="Enter capacity"
                    style="text-align: left;width: 200px; border-style:groove">
            </div>
            @if ($errors->first('capacity'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('capacity') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="price" class="col-form-label">Price: </label><br>
                <input type="number" class="form-control" name="price" placeholder="Enter price" style="text-align: left;width: 200px; border-style:groove">
            </div>
            @if ($errors->first('price'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('price') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="stock" class="col-form-label">Stock: </label><br>
                <input type="number" class="form-control" name="stock" placeholder="Enter stock" value="0" readonly style="width: 200px; border-style:groove">
            </div>
            @if ($errors->first('stock'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('stock') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="model" class="col-form-label">Model: </label><br>
                <select class="custom-select" style="width: 200px; border-style:groove" name="product_id">
                    <option value="" style="text-align: center">--Select catagory--</option>
                    @foreach ($lstProduct as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('product_id'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('product_id') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="status" class="col-form-label">Status: </label><br>
                <input type="text" class="form-control" name="status" value="0" placeholder="Enter status"
                    style="text-align: left;width:200px; border-style:groove" readonly>
            </div>
            @if ($errors->first('status'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('status') }}</p>
                </div>
            @endif
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
@stop
