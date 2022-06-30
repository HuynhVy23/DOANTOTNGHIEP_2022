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
                <label for="capacity" class="col-form-label">Capacity: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="capacity" placeholder="Enter capacity"
                    style="text-align: left">
            </div>
            @if ($errors->first('capacity'))
                <div class="error">
                    <p>{{ $errors->first('capacity') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="price" class="col-form-label">Price: <em style="color: red">*</em></label>
                <input type="number" class="form-control" name="price" placeholder="Enter price">
            </div>
            @if ($errors->first('price'))
                <div class="error">
                    <p>{{ $errors->first('price') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="stock" class="col-form-label">Stock: <em style="color: red">*</em></label>
                <input type="number" class="form-control" name="stock" placeholder="Enter stock">
            </div>
            @if ($errors->first('stock'))
                <div class="error">
                    <p>{{ $errors->first('stock') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="model" class="col-form-label">Model: <em style="color: red">*</em></label>
                <select name="product_id">
                    <option value="" style="text-align: center">--Select catagory--</option>
                    @foreach ($lstProduct as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('product_id'))
                <div class="error">
                    <p>{{ $errors->first('product_id') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="status" class="col-form-label">Status: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="status" value="0" placeholder="Enter status"
                    style="text-align: left">
            </div>
            @if ($errors->first('status'))
                <div class="error">
                    <p>{{ $errors->first('status') }}</p>
                </div>
            @endif
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
@stop
